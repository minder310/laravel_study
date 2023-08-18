<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// 引用AnimalController
use App\Http\Controllers\AnimalController;

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
// 這是預設的路由，也不知道有什麼用，先留著。
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// 設定路由，並指向AnimalController。
Route::apiResource('animals', AnimalController::class);
