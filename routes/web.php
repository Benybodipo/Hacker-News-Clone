<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NewsController;

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

Route::get('/', [NewsController::class, 'index'])->name('home');
Route::get('/news/{id}', [NewsController::class, 'show'])->name('news');
Route::get('/newstories', [NewsController::class, 'index'])->name('newstories');
Route::get('/comments', [NewsController::class, 'comments'])->name('comments');
Route::get('/comments/{id}', [NewsController::class, 'comment'])->name('comment');
Route::get('/user/{id?}', [NewsController::class, 'showUser'])->name('user');

Route::get('/newcomments', [NewsController::class, 'comments'])->name('newcomments');
Route::get('/signin', [AuthController::class, 'getSignin'])->name('get.signin');
Route::get('/signup', [AuthController::class, 'getSignup'])->name('get.signup');
