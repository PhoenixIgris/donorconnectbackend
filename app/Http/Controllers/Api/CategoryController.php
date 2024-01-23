<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    public function getCategoryList()
    {
        try {
            $categories = Category::all();
            return response()->json([
                'success' => true,
                'message' =>'Categories List fetched successfully',
                'data' => [
                    'categories' =>   $categories
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
