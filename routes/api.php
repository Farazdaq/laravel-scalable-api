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

// v1
Route::get(
    '/users',
    [\App\Http\Controllers\Api\V1\UserController::class,'index']
);


// v2
Route::get(
    '/users',
    [\App\Http\Controllers\Api\V2\UserController::class,'index']
);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
