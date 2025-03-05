<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index() {}
    public function store(Request $request)
    {
        $request->validate([
            'body' => 'required|string|max:255',
        ]); 
        $comment = Comment::create([
            'user_id' => $request->user()->id,
            'post_id' => $request->postId,
            'body' => $request->body,
        ]);

        return response()->json([$comment]);
    }
    
        
}
