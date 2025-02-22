<?php

namespace App\Http\Controllers;

use App\Models\Likes;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function index() {}
    public function store(Request $request)
    {
        $postId = $request->input('postId');
        $userId = $request->user()->id;
        Likes::firstOrCreate([
            'post_id' => $postId,
            'user_id' => $userId,
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'Liked Post Scuccessfully',
        ]);
    }
    public function destroy(Request $request, string $id)
    {
        $userId = $request->user()->id;
        Likes::where('user_id', $userId)
            ->where('post_id', $id)
            ->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Unliked Post Scuccessfully',
        ]);
    }
}
