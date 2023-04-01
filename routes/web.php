<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [PostController::class, 'create']);
Route::get('/posts/delete/{post}', [PostController::class, 'delete']);
Route::get('/posts/edit/{post}', [PostController::class, 'edit']) ->name('posts.edit');
Route::get('/posts/{post}', [PostController::class, 'show']);
Route::post('/posts/store', [PostController::class, 'store'])->name('posts.store');
Route::post('/posts/update', [PostController::class, 'update']) ->name('posts.update');
