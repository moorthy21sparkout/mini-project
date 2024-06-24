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


require __DIR__ . '/auth.php';


Route::middleware('auth')->group(function () {
    Route::resource('user_task', UserController::class);
});




Route::get('admin-home', [AdminController::class, 'index'])->name('admin-home');

Route::get('admin-create', [AdminController::class, 'create'])->name('admin-create');

Route::post('admin-store', [AdminController::class, 'store'])->name('admin-store');

Route::get('admin-show/{id}', [AdminController::class, 'show'])->name('admin-show');

Route::get('admin-edit/{id}', [AdminController::class, 'edit'])->name('admin-edit');

Route::post('admin-update/{id}', [AdminController::class, 'update'])->name('admin-update');

Route::delete('admin-delete/{id}', [AdminController::class, 'destroy'])->name('admin-delete');

Route::get('admin-notification', [AdminController::class, 'adminNotifications'])->name('admin.notifications');

Route::get('admin-assign', [AdminController::class, 'assignTask'])->name('admin-assignTask');

Route::post('admin-assign/{id}', [AdminController::class, 'assign'])->name('admin.assign');

