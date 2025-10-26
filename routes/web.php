<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;

Route::get('/', [PostController::class, 'home'])->name('index');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerStore'])->name('registerStore');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginStore'])->name('loginStore');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/post/details/{id}', [PostController::class, 'details'])->name('post.details');
Route::get('/post/author/{id}', [PostController::class, 'authorsPosts'])->name('author.index');
Route::middleware(['auth'])->group(function(){
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
Route::get('/dashboard/create-post', [PostController::class, 'create'])->name('post.create');
Route::post('/dashboard/create-post', [PostController::class, 'store'])->name('post.store');
Route::get('/posts', [PostController::class, 'index'])->name('post.index');
Route::get('/post/edit/{id}', [PostController::class, 'edit'])->name('post.edit');
Route::patch('/post/edit/{id}', [PostController::class, 'update'])->name('post.update');
Route::delete('/post/delete/{id}', [PostController::class, 'delete'])->name('post.delete');
Route::post('/post/details/{id}', [CommentController::class, 'store'])->name('comment.store');
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
Route::get('/users', [UserController::class, 'index'])->name('user.index');
Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
Route::put('/users/edit/{id}', [UserController::class, 'update'])->name('user.update');
Route::delete('/users/edit/{id}', [UserController::class, 'delete'])->name('user.delete');
Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');
Route::get('/categories/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
Route::put('/categories/edit/{id}', [CategoryController::class, 'update'])->name('category.update');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('category.create');
Route::post('/categories/create', [CategoryController::class, 'store'])->name('category.store');
Route::delete('/categories/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');
});



Route::middleware(['auth', 'admin'])->group(function(){

});
