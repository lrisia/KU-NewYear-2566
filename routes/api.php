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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register/store', [\App\Http\Controllers\Api\RegisterApiController::class, 'store'])->name('register.store');
Route::get('/employee/{id}', [\App\Http\Controllers\Api\RegisterApiController::class, 'getEmployee'])->name('register.getEmployee');
