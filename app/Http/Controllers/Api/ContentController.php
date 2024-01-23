<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Tag;
use Exception;


class ContentController extends Controller
{
    public function getInitContents()
    {
        try {
            $categories = Category::all();
            $tags = Tag::all();
            return response()->json([
                'success' => true,
                'message' =>'Categories List fetched successfully',
                'data' => [
                    'categories' =>   $categories,
                    'tags' => $tags
                ]
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
               'message' =>$e->getMessage(),
            ]);
        }

    }
}
