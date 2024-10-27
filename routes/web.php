<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryViewController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\ForumViewController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Ana sayfa rotası
Route::get('/', [HomeController::class, 'index'])->name('home');

// Misafir kullanıcılar için rotalar
Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('register');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login');
});

// Kimlik doğrulaması yapılmış kullanıcılar için rotalar
Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [HomeController::class, 'index']);
    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');

    // Resource rotaları
    Route::resource('categories', CategoryController::class);
    Route::resource('forums', ForumController::class);
    Route::resource('posts', PostController::class);

    // Özel görüntüleme rotaları
    Route::get('/categories/{category}/view', [CategoryViewController::class, 'view'])->name('categories.view');
    Route::get('/forums/{forum}/view', [ForumViewController::class, 'view'])->name('forums.view');
    
    // Kategori ile ilgili rotalar
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/{id}/forums', [ForumController::class, 'index'])->name('categories.forums');
    Route::get('/categories/show', [CategoryController::class, 'show'])->name('categories.show');
    Route::get('/categories/{category}/list', [CategoryController::class, 'list'])->name('categories.list');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
