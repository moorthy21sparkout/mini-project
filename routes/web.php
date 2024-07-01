<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', [HomeController::class, 'index']);
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('admin',ProductController::class);
Route::post('/admin/product-requests/{id}/approve', [ProductController::class, 'approveProductRequest'])->name('admin-product-request-approve');
Route::post('/admin/product-requests/{id}/reject', [ProductController::class, 'rejectProductRequest'])->name('admin-product-request-reject');


Route::get('user_add',[UserController::class,'index'])->name('user-add');
Route::post('user_store',[UserController::class,'store'])->name('user-store');
Route::get('/customer-list', [UserController::class, 'list'])->name('customer-list');
Route::get('/user/add-product', [UserController::class, 'showProductRequestForm'])->name('user.product.request.form');
Route::post('/user/add-product', [UserController::class, 'handleProductRequest'])->name('user.product.request');


require __DIR__.'/auth.php';
