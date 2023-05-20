<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReplayContrroler;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FavouriteContrroler;


// Home or Other page route
Route::get('/', [HomeController::class,'home'])->name('home');
Route::get('single-post/{id}', [PostController::class,'details'])->name('single_post');

// Auth route
Route::get('/sign-up', [UserController::class,'signup'])->name('signup');
Route::post('/signupStore', [UserController::class,'signupStore'])->name('signupStore');
Route::get('/sign-in', [UserController::class,'signin'])->name('signin');
Route::post('/signinStore', [UserController::class,'signinStore'])->name('signinStore');
Route::post('/logout', [UserController::class,'logout'])->name('logout');

// User route
Route::middleware(['auth'])->group(function () {
    Route::get('/post-create', [PostController::class,'index'])->name('post');
    Route::post('post-store', [PostController::class,'store'])->name('post_store');
    Route::get('post-edit/{id}', [PostController::class,'edit'])->name('post_edit');
    Route::post('post-update/{id}', [PostController::class,'update'])->name('post_update');
    Route::get('post-destroy/{id}', [PostController::class,'destroy'])->name('post_destroy');
    Route::get('/post-list', [PostController::class,'show'])->name('postList');

    Route::post('post-comment/{id}', [CommentController::class,'commentPost'])->name('commentPost');

    Route::post('post-replay', [ReplayContrroler::class,'commentReplay'])->name('replay');

    Route::post('post-add-favourite_', [FavouriteContrroler::class,'favourite'])->name('add_favourite_');
});

// Admin route
Route::group(['middleware' => ['auth', 'isAdmin']], function() {
    Route::get('/admin/dashboard', [DashboardController::class,'index'])->name('adminDashboard');
});

