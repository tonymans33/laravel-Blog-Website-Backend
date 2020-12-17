<?php

use App\Http\Controllers\API\UserController;
use App\Http\Controllers\Auth\DataController;
use Illuminate\Http\Request;
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

//auth routes group
Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    Route::post('register', [UserController::class, 'register']);
    Route::post('login', [UserController::class, 'authenticate']);
    Route::get('logout', [UserController::class, 'logout']);
    Route::get('open',[DataController::class, 'open']);
});

//routes which don't require authentication
Route::group(['middleware' => 'api'], function () {

    //get all categories
    Route::get('categories' , 'CategoryController@index');

    //get posts of specific category
    Route::get('categories-posts/{id}', 'CategoryController@showPosts');

    //get all posts
    Route::get('posts', 'PostController@index');

    //show specific post with answers
    Route::get('post/{id}','PostController@show');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
