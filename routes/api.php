<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('fetch-scales',[\App\Http\Controllers\ApiCollectionController::class,'fetchScales']);
Route::get('fetch-users',[\App\Http\Controllers\ApiCollectionController::class,'fetchUsers']);
Route::get('fetch-user/{email}',[\App\Http\Controllers\ApiCollectionController::class,'fetchUser']);
Route::post('add-emotion-feedback',[\App\Http\Controllers\ApiCollectionController::class,'addEmotionFeedback']);
Route::get('get-my-emotions/{email}',[\App\Http\Controllers\ApiCollectionController::class,'getMyEmotions']);
