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

Route::prefix('v1')->group(function(){
    
    // Login
    Route::post('login', [App\Http\Controllers\LoginController::class, 'login']);
    // Logout
    Route::Post('logout', [App\Http\Controllers\LoginController::class, 'logout']);
    // Register
    Route::post('register', [App\Http\Controllers\RegisterController::class, 'register']);

    Route::get('matrix', [App\Http\Controllers\v1\UserController::class, 'matrix']);

});


