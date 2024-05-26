<?php

use App\Models\Reservation;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\LaboratoryController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('reservations', ReservationController::class);
    Route::resource('laboratories', LaboratoryController::class);
    Route::get('active', [ReservationController::class, 'active'])->name('reservations.active');

});
/* Route::get('reservations/active', function () {
    $currentDateTime = now();
    $reservations = Reservation::where('user_id', auth()->id())
                    ->where('end_time', '>', $currentDateTime)
                    ->get();
    return $reservations;

})->name('reservations.active'); */
require __DIR__.'/auth.php';
