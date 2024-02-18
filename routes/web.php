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
})->name('index');

Route::post('/', [UserController::class,'login'])
->name('login');

Route::group(['middleware' => 'auth'], function() {
    Route::get('/home', [UserController::class,'getUserList'])
    ->name('user.index');

    Route::get('/user/register', [UserController::class,'formRegisterUser'])
    ->name('user.formRegister');

    Route::post('/user/register', [UserController::class,'registerUser'])
    ->name('user.register');
    
    Route::get('/user/{id}', [UserController::class,'getUserDetail'])
    ->name('user.detail');

    Route::get('/user/{id}/edit', [UserController::class,'formEditUser'])
    ->name('user.formEdit');
    
    Route::put('/user/{id}/edit', [UserController::class,'editUser'])
    ->name('user.edit');

    Route::get('/user/{id}/delete', [UserController::class,'formDeleteUser'])
    ->name('user.formDelete');

    Route::delete('/user/{id}/delete', [UserController::class,'deleteUser'])
    ->name('user.delete');
});