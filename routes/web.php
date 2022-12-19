<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\OrganizerController;
use App\Http\Controllers\PrizeController;

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
    if (\Illuminate\Support\Facades\Auth::user()) {
        return redirect()->route('staff.dashboard');
    }
    $date = new DateTime('2022-12-26T00:00:00');
    $now = new DateTime();
    if ($date > $now) { return redirect()->route('register.index'); }
    else { return redirect()->route('staff.registered'); }
})->name('/');

Route::group(['prefix' => 'register'], function() {
    Route::get('', [EmployeeController::class, 'index'])->name('register.index');
    Route::get('search', [EmployeeController::class, 'search'])->name('register.search');
});

Route::group(['prefix' => 'staff'], function() {
    Route::get('', [EmployeeController::class, 'dashboard'])->name('staff.dashboard');
    Route::get('registered', [EmployeeController::class, 'registered'])->name('staff.registered');
    Route::get('organizers', [OrganizerController::class, 'index'])->name('staff.organizers');
    Route::get('organizers/{id}', [OrganizerController::class, 'show'])->name('staff.organizers.show');
    Route::get('prizes/search', [PrizeController::class, 'search'])->name('staff.prizes.search');
    Route::get('prizes', [PrizeController::class, 'indexStaff'])->name('staff.prizes.index');
    Route::get('prizes/{id}/selected', [PrizeController::class, 'selectPrize'])->name('staff.prizes.select');
    Route::get('prizes/{id}', [PrizeController::class, 'show'])->name('staff.prizes.show');
});

Route::group(['prefix' => 'lucky-draw'], function() {
    Route::get('', [PrizeController::class, 'index'])->name('lucky-draw.index');
    Route::get('draw', [PrizeController::class, 'draw'])->name('lucky-draw.draw');
    Route::get('test', function () {return view('lucky-draw.test');})->name('lucky-draw.test');
    Route::get('button', [PrizeController::class, 'drawButton'])->name('lucky-draw.button');
});

Route::get('qr-code/{qr_code}', [EmployeeController::class, 'show'])->name('qr-code.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
