<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\OrganizerController;

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
        return redirect()->route('staff.registered');
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
    Route::get('registered', [EmployeeController::class, 'registered'])->name('staff.registered');
    Route::get('organizers', [OrganizerController::class, 'index'])->name('staff.organizers');
    Route::get('organizers/{id}', [OrganizerController::class, 'show'])->name('staff.organizers.show');
});

Route::get('qr-code/{qr_code}', [EmployeeController::class, 'show'])->name('qr-code.show');

Route::get('lucky-draw', function () {
    return view('lucky-draw.index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
