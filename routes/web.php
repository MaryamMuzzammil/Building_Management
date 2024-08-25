<?php
use App\Models\Tenant;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FlatController;
use App\Http\Controllers\RentController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\DashboardController;

    Route::middleware('auth')->group(function () {
    Route::resource('tenants', TenantController::class);
    Route::post('tenants/{tenant}/payRent', [TenantController::class, 'payRent'])->name('tenants.payRent');
    Route::get('tenants/{tenant}/rents/create', [RentController::class, 'create'])->name('rents.create');
    Route::post('tenants/{tenant}/rents', [RentController::class, 'store'])->name('rents.store');

    // Show the form for editing a specific rent payment
    Route::get('/rents/{id}/edit', [RentController::class, 'edit'])->name('rents.edit');
    // Route::put('/rents/{id}', [RentController::class, 'update'])->name('rents.update');
// web.php
// web.php
Route::get('rents/search/{tenant}', [RentController::class, 'search'])->name('rents.search');
    Route::get('/tenants/search', [TenantController::class, 'search'])->name('tenants.search');
    Route::get('rents/load_more', [RentController::class, 'loadMore'])->name('rents.load_more');
    Route::get('/tenants/{id}/form', [TenantController::class, 'showDetails'])->name('tenants.showDetails');
    Route::get('/tenants/{id}/pdf', [TenantController::class, 'generatePDF'])->name('tenants.generatePDF');

    // Update the specific rent payment
    Route::put('/rents/{id}', [RentController::class, 'update'])->name('rents.update');

    Route::get('/rents/{id}', [RentController::class, 'show'])->name('rents.show');
    // web.php
    Route::get('tenants/{tenant}/rents/search', [RentController::class, 'search'])->name('rents.search');

    Route::get('/rents/{id}/pdf', [RentController::class, 'pdfgenerate'])->name('rents.pdf');
    Route::get('/rents/receipt/{id}', [RentController::class, 'receipt'])->name('rents.receipt.download');
    Route::delete('{id}', [RentController::class, 'destroy'])->name('rents.destroy');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/flats/{flat}', [FlatController::class, 'show'])->name('flats.show');
