<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\CategoryController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

// Route::group(['prefix' => LaravelLocalization::setLocale()], function() {
Route::prefix(LaravelLocalization::setLocale())->group(function() {

    Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function() {
        Route::get('/', [AdminController::class, 'dashboard']);
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        Route::resource('categories', CategoryController::class);
        Route::resource('skills', SkillController::class);
        Route::resource('roles', RoleController::class);

    });

});

Route::get('/testss', function() {
    dd(Auth::guard('admin')->user()->role->permissions()->where('code', 'all_skills')->exists());
});

//
