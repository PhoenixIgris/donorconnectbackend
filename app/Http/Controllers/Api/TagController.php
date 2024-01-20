<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    

    public function getTagList()
    {
        $tags = Tag::all();

        return response()->json(['tags' => $tags]);
    }
}
