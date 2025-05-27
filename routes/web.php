<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\CommentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Backend
Route::get('/admin/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/admin/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/admin/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/admin/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::put('/admin/posts/{id}', [PostController::class, 'update'])->name('posts.update');
Route::delete('/admin/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

Route::get('/admin/comments', [CommentController::class, 'index'])->name('comments.index');


//Frontend
Route::get('/', [PageController::class, 'index'])->name('front.home');
Route::get('/posts/{id}', [PageController::class, 'show'])->name('post.show');

Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');