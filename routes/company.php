<?php

use App\Http\Controllers\Company\CompanyController;
use App\Http\Controllers\Company\PaymentController;
use App\Http\Controllers\Company\ProjectController;
use Illuminate\Support\Facades\Route;



Route::prefix('company')->name('company.')->middleware('auth:company')->group(function() {
    Route::redirect('/', '/company/dashboard');
    Route::get('/dashboard', [CompanyController:: class, 'dashboard'])->name('dashboard');

    Route::get('projects/status/{project?}', [ProjectController::class, 'edit_status'])->name('projects.edit_status');
    Route::resource('projects', ProjectController::class);


    Route::get('projects/{project}/pay', [PaymentController::class, 'pay'])->name('project_pay');
    Route::get('projects/{project}/payment', [PaymentController::class, 'payment'])->name('project_payment');
});

//
