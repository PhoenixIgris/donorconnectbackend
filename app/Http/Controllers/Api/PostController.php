<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Kreait\Firebase\Factory;

class PostController extends Controller
{

    public  function base64ToImage($base64String)
    {
        $image = explode('base64,', $base64String);
        $image = end($image);
        $image = str_replace(' ', '+', $image);
        $file = "images/" . uniqid() . '.png';

        Storage::disk('public')->put($file, base64_decode($image));

        return $file;
    }
    public function createPost(Request $request)
    {
        try {
            $request->validate([
                'image' => 'nullable|required',
                'title' => 'required|string',
                'desc' => 'required|string',
                'category_id' => 'nullable|integer',
                'tag_id' => 'nullable|array',
                'user_id' => 'required|integer',
            ]);
            $taglist = $request->input('tag_id');
            sort($taglist);

            // $tags = Tag::whereIn('id', $taglist)->get();
            $image = explode('base64,', $request->input('image'));
            $image = end($image);
            $image = str_replace(' ', '+', $image);
            $file = "images/" . uniqid() . '.png';

            Storage::disk('public')->put($file, base64_decode($image));
            $imageUrl = Storage::disk('public')->get($file);
            $firebase = (new Factory)
                ->withServiceAccount(base_path() . "/firebase_credential.json");
            $storage = $firebase->createStorage();
            $bucket = $storage->getBucket();
            $firebaseStoragePath = 'profile_images/' . uniqid()  . "sachita" . ".png";
            $object =  $bucket->upload($imageUrl, [
                'name' => $firebaseStoragePath,
                'predefinedAcl' => 'publicRead'
            ]);
            $publicUrl = "https://{$bucket->name()}.storage.googleapis.com/{$object->name()}";
            $user_id = $request->input('user_id');
            $user = User::findOrFail($user_id);
            $post = Post::create([
                'image' => $publicUrl,
                'title' => $request->input('title'),
                'desc' => $request->input('desc'),
                'category_id' => $request->input('category_id'),
                // 'tag_id' => $tags,
                'tag_id' => $taglist,
                'user_id' => $user_id,
                'user_image' => $user->$image
            ]);

            return response()->json([
                'success' => true,
                'message' => "Successfully created post",
                'data' => $post

            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }


    public function getAllPosts(Request $request)
    {
        try {
            $request->validate([
                'user_id' => 'required|exists:users,id',
            ]);

            $user_id = $request->input('user_id');

            $user = User::findOrFail($user_id);

            $posts = Post::where('user_id', $user_id)->get();

            return response()->json([
                'success' => true,
                'message' => 'Post were successfully fetched',
                'posts' => $posts,
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getPostsByTags(Request $request)
    {
        try {
            $requiredTagIds = $request->input('requiredtagids');
            $requiredTagId =  json_decode($requiredTagIds);
            if (!is_array($requiredTagId) || empty($requiredTagId)) {
                return response()->json(['error' => 'Invalid or empty tag IDs provided'], 400);
            }
            sort($requiredTagId);
            $posts = Post::where(function ($query) use ($requiredTagId) {
                foreach ($requiredTagId as $tagId) {
                    $query->orWhere('tag_id', 'like', "%$tagId%");
                }
            })->get();
            return response()->json([
                'success' => true,
                'message' => 'Post were successfully fetched',
                'posts' => $posts,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }


    public function getPostsByCategoryId(Request $request)
    {
        try {
            $categoryId = $request->input('category_id');
            if (empty($categoryId)) {
                return response()->json(['error' => 'Invalid or empty category ID provided'], 400);
            }
            $posts = Post::where('category_id', $categoryId)->get();
            return response()->json([
                'success' => true,
                'message' => 'Post were successfully fetched',
                'posts' => $posts,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function getPostById(Request $request)
    {
        try {
            $postId = $request->input('post_id');
            if (empty($postId)) {
                return response()->json(['error' => 'Invalid or empty ID provided'], 400);
            }
            $posts = Post::where('id', $postId)->first();
            if ($posts == null) {
                return response()->json([
                    'success' => false,
                    'message' => 'No post Found',
                ], 200);
            } else {
                return response()->json([
                    'success' => true,
                    'message' => 'Post successfully fetched',
                    'data' =>[
                        'post_detail' => $posts,
                    ]
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
