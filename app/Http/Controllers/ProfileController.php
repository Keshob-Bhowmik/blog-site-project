<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Views;
use App\Models\Comment;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(auth()->id());
        $postCount = Post::where('user_id', auth()->id())->count();
        $commentCount = Comment::wherehas('post', function ($q) {
            $q->where('user_id', auth()->id());
        })->count();
        $viewsCount = Views::wherehas('post', function ($q) {
            $q->where('user_id', auth()->id());
        })->count();
        return view('profile.index', compact('user', 'postCount', 'commentCount', 'viewsCount'));
    }
    public function edit()
    {
        $user = User::findOrFail(auth()->id());
        return view('profile.edit', compact('user'));
    }


    public function update(Request $request)
    {

        $user = User::findOrFail(auth()->id());

        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = $user->image;

        if ($request->hasFile('image')) {
            $image = $request->file('image');

           
            if ($user->image && file_exists(public_path($user->image))) {
                unlink(public_path($user->image));
            }

            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $imagePath = 'images/' . $imageName;
        }
        $user->name = $request->name;
        $user->image = $imagePath;
        $user->save();
         flash()->success('Profile Updated Successfully');
        return redirect()->route('profile.index');
    }
}
