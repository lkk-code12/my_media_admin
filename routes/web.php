<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TrendPostController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {

    // Route::get('/dashboard', function () {
    //     return view('ADMIN.PROFILE.index');
    // })->name('dashboard');

    //admin
    Route::get('dashboard',[ProfileController::class,'index'])->name('dashboard');
    Route::post('admin/update',[ProfileController::class,'adminUpdate'])->name('admin#update');
    //route for change password page
    Route::get('admin/changePasswordPage',[ProfileController::class,'changePasswordPage'])->name('admin#changePasswordPage');
    Route::post('admin/changePassword',[ProfileController::class,'changePassword'])->name('admin#changePassword');

    //admin list
    Route::get('admin/list',[ListController::class,'index'])->name('admin#list');
    Route::get('admin/delete/{id}',[ListController::class,'delete'])->name('admin#delete');
    Route::post('admin/search',[ListController::class,'search'])->name('admin#search');

    //admin category
    Route::get('admin/category',[CategoryController::class,'index'])->name('admin#category');
    //create category
    Route::post('admin/category/create',[CategoryController::class,'create'])->name('admin#createCategory');
    //category delete
    Route::get('admin/category/delete/{id}',[CategoryController::class,'delete'])->name('admin#deleteCategory');
    //search category
    Route::post('admin/category/search',[CategoryController::class,'search'])->name('admin#searchCategory');
    //edit category
    Route::get('admin/editCategoryPage/{id}',[CategoryController::class,'editCategoryPage'])->name('admin#editCategoryPage');
    //update category
    Route::post('admin/updateCategory/{id}',[CategoryController::class,'updateCategory'])->name('admin#updateCategory');

    //admin post
    Route::get('admin/post',[PostController::class,'index'])->name('admin#post');
    //admin create post
    Route::post('admin/createPost',[PostController::class,'createPost'])->name('admin#createPost');
    //delete post
    Route::get('admin/deletePost/{id}',[PostController::class,'deletePost'])->name('admin#deletePost');
    //update post page
    Route::get('admin/updatePostPage/{id}',[PostController::class,'updatePostPage'])->name('admin#updatePostPage');
    //update post
    Route::post('admin/updatePost/{id}',[PostController::class,'updatePost'])->name('admin#updatePost');

    //admin trend post
    Route::get('admin/trendPost',[TrendPostController::class,'index'])->name('admin#trendPost');
    Route::get('admin/trendPostDetails/{id}',[TrendPostController::class,'details'])->name('admin#trendPostDetails');
});
