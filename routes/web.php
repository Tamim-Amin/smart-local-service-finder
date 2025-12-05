<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AdminController;


// Public Routes
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/{service}', [ServiceController::class, 'show'])->name('services.show');

// Authentication Routes (handled by Laravel Breeze/Jetstream)
require __DIR__.'/auth.php';

Route::view('/profile', 'profile.edit')->middleware('auth')->name('profile.edit');

// Profile Routes (add these lines)
Route::middleware('auth')->group(function () {
    Route::get('/profile', function () {
        return view('profile.edit');
    })->name('profile.edit');
    
    Route::patch('/profile', function () {
        // Profile update logic here
        return back()->with('status', 'profile-updated');
    })->name('profile.update');
    
    Route::delete('/profile', function () {
        // Profile delete logic here
        return redirect('/');
    })->name('profile.destroy');
});

// Customer Routes
Route::middleware(['auth', 'role:customer'])->prefix('customer')->name('customer.')->group(function () {
    Route::get('/dashboard', function () {
        return view('customer.dashboard');
    })->name('dashboard');
    
    Route::get('/bookings', [BookingController::class, 'customerIndex'])->name('bookings');
    Route::get('/bookings/create/{service}', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    
    Route::get('/reviews/create/{booking}', [ReviewController::class, 'create'])->name('reviews.create');
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
});

// Provider Routes
Route::middleware(['auth', 'role:provider'])->prefix('provider')->name('provider.')->group(function () {
    Route::get('/dashboard', function () {
        $service = auth()->user()->service;
        return view('provider.dashboard', compact('service'));
    })->name('dashboard');
    
    Route::get('/services/create', [ServiceController::class, 'create'])->name('services.create');
    Route::post('/services', [ServiceController::class, 'store'])->name('services.store');
    Route::get('/services/{service}/edit', [ServiceController::class, 'edit'])->name('services.edit');
    Route::put('/services/{service}', [ServiceController::class, 'update'])->name('services.update');
    
    Route::get('/bookings', [BookingController::class, 'providerIndex'])->name('bookings');
    Route::post('/bookings/{booking}/accept', [BookingController::class, 'accept'])->name('bookings.accept');
    Route::post('/bookings/{booking}/reject', [BookingController::class, 'reject'])->name('bookings.reject');
    Route::post('/bookings/{booking}/complete', [BookingController::class, 'complete'])->name('bookings.complete');
});

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    Route::get('/users', [AdminController::class, 'users'])->name('users.index');
    Route::post('/users/{user}/block', [AdminController::class, 'blockUser'])->name('users.block');
    Route::post('/users/{user}/unblock', [AdminController::class, 'unblockUser'])->name('users.unblock');
    
    Route::resource('categories', CategoryController::class)->except(['show']);
    
    Route::get('/verifications', [AdminController::class, 'pendingVerifications'])->name('verifications.index');
    Route::post('/services/{service}/approve', [AdminController::class, 'approveService'])->name('services.approve');
    Route::post('/services/{service}/reject', [AdminController::class, 'rejectService'])->name('services.reject');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');