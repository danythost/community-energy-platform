<?php

require __DIR__.'/auth.php';

use App\Http\Controllers\OnboardingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EnergyEventController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

#Default Route / is Login
Route::get('/', function () {
    return view('auth.login');
})->name('login');

#Dashboard Route
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'initialized'])->name('dashboard');

#Middleware Route
#Middleware Route
Route::middleware(['auth', 'initialized'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/energy/report', [EnergyEventController::class, 'store'])->name('energy.report');
});

#Onboarding Route
Route::middleware('auth')->group(function () {

    Route::get('/onboarding', [OnboardingController::class, 'show'])
        ->name('onboarding');

    Route::post('/onboarding', [OnboardingController::class, 'store'])
        ->name('onboarding.store');
});

#Stewards View
Route::middleware(['auth', 'initialized', 'steward'])->group(function () {

    Route::get('/steward/dashboard', function () {
        // Redundant check removed since middleware handles it, but kept for double safety if desired or refactor later
        $events = \App\Models\EnergyEvent::with(['user', 'zone'])
            ->where('zone_id', auth()->user()->zone_id)
            ->latest()
            ->take(20)
            ->get();

        return view('steward.dashboard', compact('events'));
    })->name('steward.dashboard');

    // Admin User Creation
    Route::get('/admin/users/create', [\App\Http\Controllers\AdminUserController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users', [\App\Http\Controllers\AdminUserController::class, 'store'])->name('admin.users.store');

    // Energy Event Validation
    Route::post('/energy/validate', \App\Http\Controllers\EnergyEventValidationController::class)->name('energy.validate');

});


#require __DIR__.'/auth.php';
