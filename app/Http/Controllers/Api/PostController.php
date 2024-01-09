<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function createPost(Request $request)
    {
        $request->validate([
            'image' => 'nullable|string',
            'title' => 'required|string',
            'desc' => 'required|string',
            'category_id' => 'nullable|integer',
            'tag_id' => 'nullable|array',
            'user_id' => 'required|integer',
        ]);
    
        $tag_id = $request->has('tag_id') ? json_encode($request->input('tag_id')) : null;
    
        $post = Post::create([
            'image' => $request->input('image'),
            'title' => $request->input('title'),
            'desc' => $request->input('desc'),
            'category_id' => $request->input('category_id'),
            'tag_id' => $tag_id,
            'user_id' => $request->input('user_id'),
        ]);
    
        return response()->json(['post' => $post], 201);
    }
    

    public function getAllPosts(Request $request) {
        try {
            $request->validate([
                'user_id' => 'required|exists:users,id',
            ]);
    
            $user_id = $request->input('user_id');
    
            $user = User::findOrFail($user_id);
    
            $posts = Post::where('user_id', $user_id)->get();
    
            return response()->json(['posts' => $posts]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
