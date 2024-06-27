<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::middleware(['admin'])->prefix('admin')->group(function () {
    Route::get('home', [AdminController::class, 'index'])->name('admin-home');
    Route::get('create', [AdminController::class, 'create'])->name('admin-create');
    Route::post('store', [AdminController::class, 'store'])->name('admin-store');
    Route::get('show/{id}', [AdminController::class, 'show'])->name('admin-show');
    Route::get('edit/{id}', [AdminController::class, 'edit'])->name('admin-edit');
    Route::post('update/{id}', [AdminController::class, 'update'])->name('admin-update');
    Route::delete('delete/{id}', [AdminController::class, 'destroy'])->name('admin-delete');
    Route::get('assign', [AdminController::class, 'assignTask'])->name('admin-assignTask');
    Route::post('assign/{id}', [AdminController::class, 'assign'])->name('admin.assign');
    Route::post('search', [AdminController::class, 'search'])->name('search-filter');
});