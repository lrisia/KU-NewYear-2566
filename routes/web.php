<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\OrganizerController;
use App\Http\Controllers\PrizeController;
use App\Http\Controllers\LuckyDrawController;
use Illuminate\Support\Facades\Auth;

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
    if (Auth::user()) {
        if (Auth::user()->isStaff()) return redirect()->route('staff.dashboard');
        else if (Auth::user()->isRegister()) return redirect()->route('staff.prizes');
    }
    $date = new DateTime('2023-12-21T00:00:00');
    $now = new DateTime();
    if ($date > $now) { return redirect()->route('register.index'); }
    else { return redirect()->route('lucky-draw.show.no-id'); }
})->name('/');

Route::group(['prefix' => 'register'], function() {
   Route::get('', [EmployeeController::class, 'index'])->name('register.index');
   Route::get('search', [EmployeeController::class, 'search'])->name('register.search');
});

Route::get('qr-code/{qr_code}', [EmployeeController::class, 'show'])->name('qr-code.show');

Route::group(['prefix' => 'staff'], function() {
    Route::get('', [OrganizerController::class, 'dashboard'])->name('staff.dashboard');

    Route::group(['prefix' => 'employees'], function() {
        Route::get('', [EmployeeController::class, 'all'])->name('staff.employees');
        Route::get('registered', [EmployeeController::class, 'registered'])->name('staff.employees.registered');
        Route::get('attended', [EmployeeController::class, 'attended'])->name('staff.employees.attended');
        Route::get('upload', [EmployeeController::class, 'showUpload'])->name('staff.employees.upload.show');
        Route::post('create', [EmployeeController::class, 'create'])->name('staff.employees.create');
        Route::post('upload', [EmployeeController::class, 'createUpload'])->name('staff.employees.upload.create');
    });

    Route::group(['prefix' => 'organizers'], function() {
        Route::get('', [OrganizerController::class, 'index'])->name('staff.organizers');
        Route::get('{id}', [OrganizerController::class, 'show'])->name('staff.organizers.show');
    });

    Route::group(['prefix' => 'prizes'], function() {
        Route::get('', [PrizeController::class, 'index'])->name('staff.prizes');
        Route::get('close', [PrizeController::class, 'close'])->name('staff.prizes.close');
        Route::get('search', [PrizeController::class, 'search'])->name('staff.prizes.search');
        Route::post('select', [PrizeController::class, 'selectPrize'])->name('staff.prizes.select');
        Route::get('{id}', [PrizeController::class, 'show'])->name('staff.prizes.show');
    });
});

Route::group(['prefix' => 'lucky-draw'], function() {
    Route::get('', [PrizeController::class, 'draw'])->name('lucky-draw.draw');
    Route::get('test', function () {return view('lucky-draw.test');})->name('lucky-draw.test');
    Route::get('button', [PrizeController::class, 'drawButton'])->name('lucky-draw.button');
});

Route::group(['prefix' => 'lucky-person'], function() {
    Route::get('{id}', [LuckyDrawController::class, 'show'])->name('lucky-draw.show');
    Route::get('', [LuckyDrawController::class, 'index'])->name('lucky-draw.show.no-id');
});
Route::get('lucky-person-qr', function () { return view('lucky-draw.qr-code'); });

Route::get('staff/qr-code/scan', [EmployeeController::class, 'scan'])->name('qr-code.scan');

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('entrance/qr-login/{email}/{token}', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'qrLogin']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
