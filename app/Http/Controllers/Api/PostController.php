<?php

namespace App\Http\Controllers\Api;

use App\Enums\Status;
use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Bookmark;
use App\Models\Post;
use App\Models\RequestQueue;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Kreait\Firebase\Factory;
use Symfony\Component\Process\Process;

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
                'address' => 'required|string',
                'latitude' => 'required|numeric',
                'longitude' => 'required|numeric',
            ]);
            $taglist = $request->input('tag_id');
            sort($taglist);
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
            $address = Address::create([
                'name' => $request->input('address'),
                'latitude' => $request->input('latitude'),
                'longitude' => $request->input('longitude')
            ]);
            $post = Post::create([
                'image' => $publicUrl,
                'title' => $request->input('title'),
                'desc' => $request->input('desc'),
                'category_id' => $request->input('category_id'),
                'user_id' => $user_id,
            ]);
            $post->address()->associate($address);
            $post->save();
            $post->tags()->attach($taglist);
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
            $posts = Post::with(['user', 'tags', 'requestQueues', 'address'])->get();

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
            $posts = Post::with(['user', 'address', 'tags'])->whereHas('tags', function ($query) use ($requiredTagId) {
                $query->whereIn('tag_id', $requiredTagId);
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
            $posts = Post::with('user', 'tags')->where('category_id', $categoryId)->get();
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
            $posts = Post::with(['user', 'category', 'tags'])->where('id', $postId)->first();
            if ($posts == null) {
                return response()->json([
                    'success' => false,
                    'message' => 'No post Found',
                ], 200);
            } else {
                return response()->json([
                    'success' => true,
                    'message' => 'Post successfully fetched',
                    'data' => [
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

    public function requestPost(Request $request)
    {
        try {
            $postId = $request->input('post_id');
            $post = Post::where('id', $postId)->first();
            $userId = $request->input('user_id');
            if (RequestQueue::where('post_id', $postId)->where('user_id', $userId)->exists()) {
                return response()->json([
                    'success' => true,
                    'message' => 'You have already requested this post.'
                ], 200);
            }
            $isFirstRequest = !RequestQueue::where('post_id', $postId)->exists();
            $lastPosition = RequestQueue::where('post_id', $postId)->max('position') ?? 0;
            $request = RequestQueue::create([
                'post_id' => $postId,
                'user_id' => $userId,
                'position' => $lastPosition + 1
            ]);
            if ($isFirstRequest) {
                $post->update([
                    'current_request_user_id' => $userId,
                    'status' => Status::REQUESTED
                ]);
                return response()->json([
                    'success' => true,
                    'message' => 'Request added to the queue.',
                    'isFirstRequest' => $isFirstRequest,
                    'delivery_details' => [
                        'message' => 'Please receive your item in the following location and time with given code. ',
                        'address' => $post->address,
                        'contact_number' => $post->phone_number
                    ]
                ]);
            } else {
                $position = $lastPosition + 1;
                $post->update(['pending_request_status' => Status::PENDING_REQUEST]);
                $message = 'Request added to the queue. You are currently in ';
                if ($position == 1) {
                    $message .= $position . 'st in line';
                } elseif ($position == 2) {
                    $message .= $position . 'nd in line';
                } elseif ($position == 3) {
                    $message .= $position . 'rd in line';
                } else {
                    $message .= $position . 'th in line';
                }
                return response()->json([
                    'success' => true,
                    'message' => $message,
                    'isFirstRequest' => $isFirstRequest,
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function cancelRequest(Request $request)
    {
        try {
            $postId = $request->input('post_id');
            $post = Post::findOrFail($postId);
            $userId = $request->input('user_id');
            $requestQueue = RequestQueue::where('post_id', $postId)->where('user_id', $userId)->first();

            if (!$requestQueue) {
                return response()->json(['message' => 'Request not found in the queue.'], 404);
            }
            RequestQueue::where('post_id', $postId)
                ->where('position', '>', $requestQueue->position)
                ->decrement('position');;
            $requestQueue->delete();
            $smallestPositionRequest = RequestQueue::where('post_id', $postId)
                ->orderBy('position', 'asc')
                ->first();
            if ($smallestPositionRequest) {
                $post->update([
                    'current_request_user_id' => $smallestPositionRequest->user_id,
                    'pending_request_status' => Status::PENDING_REQUEST
                ]);
            } else {
                $post->update([
                    'current_request_user_id' => null,
                    'pending_request_status' => Status::VERIFIED
                ]);
            }


            return response()->json([
                'success' => true,
                'message' => 'Request removed from the queue.',
                'request' => $requestQueue->position,
                'previous' => $smallestPositionRequest
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }



    public function userRequests(Request $request)
    {
        try {
            $userId = $request->input('user_id');
            $userRequests = RequestQueue::where('user_id', $userId)
                ->with(['post', 'post.user', 'post.tags'])
                ->orderBy('position')
                ->get();
            if ($userRequests->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No requests found.'
                ], 200);
            }
            return response()->json([
                'success' => true,
                'message' => 'List Fetched Successfully.',
                'user_requests' => $userRequests
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'User not found.'
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function bookmarkPost(Request $request)
    {
        $userId = $request->input('user_id');
        $postId = $request->input('post_id');
        $user = User::find($userId);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $bookmark = Bookmark::where('user_id', $userId)->where('post_id', $postId)->first();

        if ($bookmark) {
            $user->bookmarks()->detach($postId);
            $bookmark->delete();
            return response()->json(['message' => 'Post unbookmarked successfully']);
        } else {
            $bookmark = new Bookmark();
            $bookmark->user_id = $userId;
            $bookmark->post_id = $postId;
            $bookmark->save();
            return response()->json(['message' => 'Post bookmarked successfully']);
        }
    }



    public function getBookmarkedPosts(Request $request)
    {
        $userId = $request->input('user_id');
        $user = User::find($userId);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $bookmarkedPosts = $user->bookmarks()->with(['user', 'category', 'tags'])->get();

        return response()->json([
            'success' => true,
            'message' => "Posts fetched successfully",
            'posts' => $bookmarkedPosts
        ]);
    }

    public function getRecommendedPosts(Request $request)
    {
        try {
            $postId = $request->input('post_id');
            $post =  Post::with('tags', 'category')->where('id', $postId)->get()->first();
            $postKeyword = $post->title . ' ' . $post->category->name . ' ';
            foreach ($post->tags as $tag) {
                $postKeyword . $tag->name . ' ';
            }
            $posts = Post::with('tags', 'category')->where('id', '!=', $postId)->get();
            $keywords = [];
            foreach ($posts as $post) {
                $keywords[$post->title] = $post->id;
                $keywords[$post->category->name] = $post->id;
                foreach ($post->tags as $tag) {
                    $keywords[$tag->name] = $post->id;
                }
            }
            $process = new Process(['python3', 'algorithm/cosinealgorithm.py', json_encode($postKeyword), json_encode($keywords)]);
            $process->run();

            // Execute Python script and get recommended posts

            if (!$process->isSuccessful()) {
                throw new \RuntimeException($process->getErrorOutput());
            }
            $recommended_posts = json_decode($process->getOutput(), true);

            $posts = Post::with(['user', 'tags', 'requestQueues', 'address'])->whereIn('id', $recommended_posts)->get();

            return response()->json(
                [
                    'success' => true,
                    'message' => "Posts fetched successfully",
                    'posts' => $posts
                ]

            );
        } catch (Exception $e) {
            return response()->json(
                [
                    'success' => true,
                    'message' => $e->getMessage(),
                ]

            );
        }
    }
}
