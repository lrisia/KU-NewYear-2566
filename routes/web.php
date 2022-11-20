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
    return redirect()->route('register.index');
});

Route::group(['prefix' => 'register'], function() {
    Route::get('', [EmployeeController::class, 'index'])->name('register.index');
    Route::get('search', [EmployeeController::class, 'search'])->name('register.search');
});

Route::get('qr-code/{qr_code}', [EmployeeController::class, 'show'])->name('qr-code.show');
