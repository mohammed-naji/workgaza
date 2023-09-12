<?php

use App\Http\Controllers\FrontController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProductApiController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [FrontController::class, 'index'])->name('front.index');
Route::get('/projects/{category?}', [FrontController::class, 'projects'])->name('front.projects');

Route::get('/dashboard', function () {

    if(Auth::guard('admin')->check()) {
        return redirect()->route('admin.dashboard');
    }

    if(Auth::guard('company')->check()) {
        return redirect()->route('company.dashboard');
    }

    return view('dashboard');
})->middleware(['auth:web,admin,company', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Api Routes
Route::get('products', [ProductApiController::class, 'index']);
Route::get('weather', [ProductApiController::class, 'weather']);

// Notifications Route
Route::get('send', [NotificationController::class, 'send']);
Route::get('read', [NotificationController::class, 'read']);
Route::get('read/{id}', [NotificationController::class, 'mark_read'])->name('mark_read');

Route::get('adminpanel', function() {
    return 'Admin Page';
})->middleware('auth', 'is_admin');

//
