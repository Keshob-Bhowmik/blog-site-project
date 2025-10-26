<?php

namespace App\Http\Controllers;

use view;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function index(Request $request){
        $query = User::query();
        if ($request->has('name') && !empty($request->name)) {
            $query->where('name', 'like', '%'. $request->name. '%');
        }
        if($request->has('role') && !empty($request->role)){
            $query->where('role', $request->role);
        }
        $users = $query->latest()->paginate(10);
        $adminCount = User::where('role', 'admin')->count();
        $regularCount = User::where('role', 'user')->count();
        return view('users.index', compact('users', 'adminCount', 'regularCount'));
    }
    public function edit($id){
        $user = User::findorfail($id);
        return view('users.edit', compact('user'));
    }
    public function update(Request $request, $id){
        $user = User::findorfail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|max:300|email|unique:users,email,'. $user->id,
            'role' => 'required|in:admin,user',
        ]);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->save();
        flash()->success('User Updated successfully!');
        return redirect()->route('user.index');
    }
    public function delete($id){
        $user = User::findorfail($id);
        $user->delete();
        flash()->success('User deleted successfully!');
        return redirect()->route('user.index');
    }
}
