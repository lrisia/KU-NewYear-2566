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
Route::get('/employee/get', [\App\Http\Controllers\Api\RegisterApiController::class, 'getEmployee'])->name('register.get-employee');
Route::get('/prize/{id}/get', [\App\Http\Controllers\Api\PrizeApiController::class, 'get'])->name('prize.get');
Route::get('/prize/{id}/draw', [\App\Http\Controllers\Api\PrizeApiController::class, 'draw'])->name('prize.draw');
Route::get('/prize/{id}/employee', [\App\Http\Controllers\Api\PrizeApiController::class, 'getLuckyPerson'])->name('prize.lucky-person');
Route::post('staff/qr-code/store/attend', [\App\Http\Controllers\Api\EmployeeApiController::class, 'arrived'])->name('qr-code.attend');

