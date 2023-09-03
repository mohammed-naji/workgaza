<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

// Route::group(['prefix' => LaravelLocalization::setLocale()], function() {
Route::prefix(LaravelLocalization::setLocale())->group(function() {

    Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function() {
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        Route::resource('categories', CategoryController::class);

    });

});

//
