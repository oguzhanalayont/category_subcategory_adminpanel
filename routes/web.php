<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryViewController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\ForumViewController;
use App\Http\Controllers\PostController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::resource('categories', CategoryController::class);
Route::resource('forums', ForumController::class);
Route::resource('posts', PostController::class);
Route::get('/categories/{id}/forums', [ForumController::class, 'index'])->name('categories.forums');
Route::get('/categories/{category}', [CategoryViewController::class, 'view'])->name('categories.view');
Route::get('/forums/{forum}', [ForumViewController::class, 'view'])->name('forums.view');