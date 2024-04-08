<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/register', [RegisterController::class, 'show_register_view'])->name('show_register_view');
Route::post('/register', [RegisterController::class, 'register_user'])->name('register');
Route::get('/login', [LoginController::class, 'show_login_view'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/create', [HomeController::class, 'create_view'])->name('create')->middleware('admin');
Route::post('/create', [HomeController::class, 'create'])->middleware('admin');
Route::get('/posts/all', [HomeController::class, 'index'])->name('home_page')->middleware('auth');
Route::get('/posts/published', [HomeController::class, 'showPublished'])->name('show_published')->middleware('auth');
Route::get('/posts/drafts', [HomeController::class, 'showDrafts'])->name('show_drafts')->middleware('admin');
Route::get('/post/{post_id}', [HomeController::class, 'show'])->name('show_page')->middleware('auth');

Route::delete('/post/{post_id}/delete', [HomeController::class, 'delete'])->name('post_delete')->middleware('admin');
Route::put('/post/{post_id}/edit', [HomeController::class, 'edit'])->name('post_edit')->middleware('admin');
