<?php

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ActionLogController;






// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('user/login',[AuthController::class,'login']);
Route::post('user/register',[AuthController::class,'register']);

Route::get('category',function(){
    $category = Category::get();
    return response()->json([
        'category' => $category
    ]);
})->middleware('auth:sanctum');

//post api
Route::get('allPostList',[PostController::class,'getAllPost']);
//post search
Route::post('postSearch',[PostController::class,'postSearch']);
Route::post('postDetails',[PostController::class,'postDetails']);

//category api
Route::get('allCategoryList',[CategoryController::class,'getAllCategory']);
//category search
Route::post('categorySearch',[CategoryController::class,'categorySearch']);

//action log
Route::post('actionLogPost',[ActionLogController::class,'actionLogPost']);
