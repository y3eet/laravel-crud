<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource. GET
     */
    public function index(Request $request)
    {
        $posts = Post::with('user')->orderBy('updated_at', 'desc')->get();
        return view('components.load-post', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage. POST
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);
        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => $request->user()->id,
        ]);
        $post->load('user');
        return response()->json($post);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::with('user')->findOrFail($id);
        return view('posts.post', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage. UPDATE
     */
    public function update(Request $request, string $id)
    {
        //
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);
        $post = Post::findOrFail($id);
        $post->update($validated);
        return response()->json([
            'status' => 'success',
            'message' => 'Updated Post Scuccessfully',
            'post' => $post,
        ]);
    }

    /**
     * Remove the specified resource from storage. DELETE
     */
    public function destroy(Request $request, string $id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Deleted Post Scuccessfully',
            'post' => $post,
        ]);
    }
}
