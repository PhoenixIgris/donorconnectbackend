<?php

use App\Http\Controllers\Api\MapController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\ContentController;
//use App\Http\Controllers\MapController;


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
    Route::get('edit',  'edit');
    Route::put('update',  'update');
    Route::post('logout', 'logout');
});



Route::group(['prefix' => 'post'], function () {
    Route::post('createPost', [PostController::class, 'createPost']);
    Route::post('getAllPosts', [PostController::class, 'getAllPosts']);
    Route::post('getPost', [PostController::class, 'getPostById']);
    Route::post('getPostsByTags', [PostController::class, 'getPostsByTags']);
    Route::post('getPostsByCategoryId', [PostController::class, 'getPostsByCategoryId']);
    Route::post('requestPost', [PostController::class, 'requestPost']);
    Route::post('cancelRequest', [PostController::class, 'cancelRequest']);
    Route::post('userRequests', [PostController::class, 'userRequests']);
    Route::post('bookmarkPost', [PostController::class, 'bookmarkPost']);
    Route::post('getBookmarkedPosts', [PostController::class, 'getBookmarkedPosts']);
    Route::post('getRecommendedPosts', [PostController::class, 'getRecommendedPosts']);
    Route::post('searchPosts', [PostController::class, 'searchposts']);
});



Route::group(['prefix' => 'category'], function () {
    Route::get('getCategoryList', [CategoryController::class, 'getCategoryList']);
});

Route::group(['prefix' => 'tag'], function () {
    Route::get('getTagList', [TagController::class, 'getTagList']);
});

Route::group(['prefix' => 'content'], function () {
    Route::get('init-content', [ContentController::class, 'getInitContents']);
});



Route::group(['prefix' => 'map'], function () {
    Route::post('getLocation', [MapController::class, 'getLocation']);
    Route::get('showMap', [MapController::class, 'showMap']);

});
  





