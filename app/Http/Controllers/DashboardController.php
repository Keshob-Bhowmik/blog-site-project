<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    //
    public function index(){

        if(auth()->check() && auth()->user()->role == 'admin'){
            $posts = Post::latest()->paginate(10);
        } else{
            $posts = Post::where('user_id', auth()->id())->latest()->paginate(10);
        }

        $categories = Category::all();
        $users = User::all();
        $totalPostsCount = Post::count();
        return view('dashboard.index', compact('posts', 'categories', 'users', 'totalPostsCount'));
    }

}

