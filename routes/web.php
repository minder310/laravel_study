<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimalController;

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

Route::get('/', function () {
    return view('welcome');
});
// 這種寫法要你上面有宣告use App\Http\Controllers\AnimalController;才可以使用。後面的name是可以直接使用在前端，例如:route('animal.index')。
Route::get('/animal', [AnimalController::class, 'index'])->name('animal.index');
