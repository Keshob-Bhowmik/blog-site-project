<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //
    public function store(Request $request, $id){
        $request->validate([
            'body'=> 'required|max:500'
        ]);

        $comment = new Comment();
        $comment->body = $request->body;
        $comment->post_id = $id;
        $comment->user_id = auth()->id();
        $comment->save();

        flash()->success('Comment added Successfully');
        return redirect()->back();
    }
}
