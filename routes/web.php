<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;

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
//    if \Illuminate\Support\Facades\Auth::user()
    return view('test');
});

Route::group(['prefix' => 'register'], function() {
    Route::get('', [EmployeeController::class, 'index']);
    Route::get('search', [EmployeeController::class, 'search']);
    Route::post('store', [EmployeeController::class, 'store']);
    Route::get('{id}/qr-code', [EmployeeController::class, 'show']);
});

Route::get('qr-code/{qr_code}', [EmployeeController::class, 'show']);
