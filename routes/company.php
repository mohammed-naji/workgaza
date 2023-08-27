<?php

use App\Http\Controllers\Company\CompanyController;
use App\Http\Controllers\Company\ProjectController;
use Illuminate\Support\Facades\Route;



Route::prefix('company')->name('company.')->group(function() {
    Route::redirect('/', '/company/dashboard');
    Route::get('/dashboard', [CompanyController:: class, 'dashboard'])->name('dashboard');

    Route::resource('projects', ProjectController::class);
});

//
