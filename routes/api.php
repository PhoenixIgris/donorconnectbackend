<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Api\PostController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::controller(AuthController::class)->group(function(){
    Route::post('login', 'login');
    Route::post('register', 'register');
});


Route::group(['prefix' => 'post'], function () {
    Route::post('createPost', [PostController::class, 'createPost']);
    Route::post('getAllPosts', [PostController::class, 'getAllPosts']);
});


Route::group(['prefix' => 'category'], function () {
    Route::get('getCategoryList', [CategoryController::class, 'getCategoryList']);
});

Route::group(['prefix' => 'tag'], function () {
    Route::get('getTagList', [TagController::class, 'getTagList']);
});




