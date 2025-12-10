<?php

use App\Http\Controllers\Admin\AdminCompanyController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;



Route::get('/', [AdminCompanyController::class, 'index'])->name('companies.index');
Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/companies', [AdminCompanyController::class, 'index'])->name('companies.index');
        Route::get('/companies/{company}', [AdminCompanyController::class, 'show'])->name('companies.show');
});

require __DIR__ . '/auth.php';
