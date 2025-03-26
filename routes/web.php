<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryViewController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\ForumViewController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminForumController;
use Illuminate\Support\Facades\Auth;
Auth::routes();

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/forums', [ForumController::class, 'index'])->name('forums.index');
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

// Guest routes
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('register');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login');
});

// Admin routes
Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
 
    Route::get('/forums/create', [ForumController::class, 'create'])->name('forums.create');
    Route::post('/forums', [ForumController::class, 'store'])->name('forums.store');
    Route::get('/forums', [ForumController::class, 'index'])->name('forums.index');
    Route::get('/forums/{forum}/edit', [ForumController::class, 'edit'])->name('forums.edit');
    Route::put('/forums/{forum}', [ForumController::class, 'update'])->name('forums.update');
    Route::delete('/forums/{forum}', [ForumController::class, 'destroy'])->name('forums.destroy');
});
// Authenticated user routes
Route::group(['middleware' => 'auth'], function () {
   Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
   
   // User can only manage posts and comments
   Route::resource('posts', PostController::class);
   Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
   Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

   // View routes
   Route::get('/categories/{category}/view', [CategoryViewController::class, 'view'])->name('categories.view');
   Route::get('/forums/{forum}/view', [ForumViewController::class, 'view'])->name('forums.view');
   Route::get('/categories/show', [CategoryController::class, 'show'])->name('categories.show');
   Route::get('/categories/{category}/list', [CategoryController::class, 'list'])->name('categories.list');
   Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
});