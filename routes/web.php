<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login');
})->name('guest.index');

Route::post('/', [UserController::class,'login'])
->name('guest.login');

Route::group(['middleware' => 'auth'], function() {
    Route::get('/home', [UserController::class,'getList'])
    ->name('user.index');
});