<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\User;
use App\Notifications\UserTaskCreatedNotification;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [HomeController::class, 'index']);

Route::get('/home', [HomeController::class, 'redirect']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::resource('user_task', UserController::class);
});

Route::get('admin-home', [AdminController::class, 'index'])->name('admin-home');

Route::get('admin-create', [AdminController::class, 'create'])->name('admin-create');

Route::post('admin-store', [AdminController::class, 'store'])->name('admin-store');

Route::get('admin-show/{id}', [AdminController::class, 'show'])->name('admin-show');


Route::patch('admin-edit', [AdminController::class, 'edit'])->name('admin-edit');

Route::patch('admin-update', [AdminController::class, 'update'])->name('admin-update');


Route::middleware(['auth'])->group(function () {
    // Routes requiring authentication
    Route::get('admin-notification', [AdminController::class, 'notifications'])->name('admin.notifications');
});
Route::view('notify', 'user.notification')->name('user-notification');

Route::view('e-mail', 'user.e-mail')->name('user-email');

require __DIR__ . '/auth.php';
