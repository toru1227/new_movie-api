<?php

use App\Http\Controllers\EditController;
use Illuminate\Http\Request;
use App\Http\Controllers\LikesController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\Master_loginController;
use App\Http\Controllers\Master_logoutController;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\UserReviewController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;
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

Route::apiResource('/review', ReviewsController::class);
Route::get('/', [MoviesController::class, 'get']);
Route::post('/movie_post', [MoviesController::class, 'post']);
Route::get('/edit', [EditController::class, 'edit']);
Route::post('/edit', [EditController::class, 'update']);
Route::post('/signup', [RegisterController::class, 'post']);
Route::post('/login', [LoginController::class, 'post']);
Route::post('/logout', [LogoutController::class, 'post']);
Route::get('/user_review', [UserReviewController::class, 'get']);
Route::get('/user', [UsersController::class, 'get']);
Route::post('/like', [LikesController::class, 'post']);
Route::delete('/like', [LikesController::class, 'delete']);
Route::post('/master_login',[Master_loginController::class,'post']);
Route::post('/master_logout',[Master_logoutController::class,'post']);
