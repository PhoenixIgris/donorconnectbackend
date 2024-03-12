<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Exception;


class TagController extends Controller
{


    public function getTagList()
    {

        try {
            $tags = Tag::all();
            return response()->json([
                'success' => true,
                'message' =>'Tag List fetched successfully',
                'data' => [
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
