<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



// start of public routes
// Registration route
Route::post('/register',[AuthController::class,'register']);
// Login Route
Route::post('/login',[AuthController::class,'login']);

// End of public routes

// For protected Routes

Route::group(['middleware'=>['auth:sanctum']],function(){

    // For User Routes
    // For user details
    Route::get('/user',[AuthController::class,'user']);
    // Logout Route
    Route::post('/logout',[AuthController::class,'logout']);


    // start of post routes
    Route::get('/posts',[PostController::class,'index']); //For all posts
    Route::post('/posts',[PostController::class,'store']); //For post creation
    Route::get('/posts/{id}',[PostController::class,'show']); //For post details
    Route::put('/posts/{id}',[PostController::class,'update']); //For update post
    Route::delete('/posts/{id}',[PostController::class,'destroy']); //For post deletion
    // end of posts routes

    
    // start of comment routes
    Route::get('/posts/{id}/comments',[CommentController::class,'index']); //For all comments of a post
    Route::post('/posts/{id}/comments',[CommentController::class,'store']); //For comment creation
    Route::put('/comments/{id}',[CommentController::class,'update']); //For update coment
    Route::delete('/comments/{id}',[CommentController::class,'destroy']); //For comment deletion
    // end of comment routes


    // start of like routes
    Route::get('/posts/{id}/likes',[LikeController::class,'likeOrunlike']); //Like or dislike a post
});
// ---/--
