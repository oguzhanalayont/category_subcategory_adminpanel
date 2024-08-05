<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryViewController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\ForumViewController;
use App\Http\Controllers\PostController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// CRUD rotaları
Route::resource('categories', CategoryController::class);
Route::resource('forums', ForumController::class);
Route::resource('posts', PostController::class);

// Yeni view rotaları
Route::get('/categories/{category}/view', [CategoryViewController::class, 'view'])->name('categories.view');
Route::get('/forums/{forum}/view', [ForumViewController::class, 'view'])->name('forums.view');
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{id}/forums', [ForumController::class, 'index'])->name('categories.forums');
Route::get('/categories/show', [CategoryController::class, 'show'])->name('categories.show');