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
        Comment::create([
            'user_id' => $request->user()->id,
            'post_id' => $request->postId,
            'parent_id' => $request->parentId,
            'body' => $request->body,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Commented Scuccessfully',
        ]);
    }
    public function delete (Request $request, string $id)
    {
        $userId = $request->user()->id;
        Comment::where('user_id', $userId)
        ->where('id', $id)
        ->delete();
        
        return response()->json([
            'status' => 'success',
            'message' => 'Deleted Comment Scuccessfully',
        ]);
    }
    
        
}
