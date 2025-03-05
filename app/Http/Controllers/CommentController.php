<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Request $request) 
    {
        $comments = Comment::whereNull('parent_id')
        ->where('post_id', $request->postId)
        ->with('user')
        ->with('children')
        ->get();
        return view('components.load-comments', ['comments' => $comments]);
        //return response()->json([$request->postId]);
    }
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
