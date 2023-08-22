<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function() {
    Route::get('dashboard/{lang?}', [AdminController::class, 'dashboard'])->name('dashboard');
});



//
