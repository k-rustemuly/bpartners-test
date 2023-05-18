<?php

use App\Http\Controllers\BasketController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

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

Route::controller(BasketController::class)->group(function(){

    Route::post('basket-add', 'add');

});

Route::controller(CategoryController::class)->group(function(){

    Route::get('category', 'list');

});
