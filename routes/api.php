<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController as Post;
use App\Http\Controllers\AuthController as Auth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', [Auth::class, 'register']);
Route::post('login', [Auth::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->group(function(){
    Route::resource('post', Post::class);
});

