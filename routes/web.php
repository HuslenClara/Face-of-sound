<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers;

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


Route::get('/', [HomeController::class, 'index']);
Route::get('/dashboard', [HomeController::class, 'dashboard']);
 
Route::get('/home', [HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/app', function() {
	return view('layouts.app');
});

Route::resource('posts', PostController::class);
Route::get('/posts/{post}/collab',[PostController::class, 'collab']);


Route::resource('events', EventController::class);
