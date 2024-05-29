<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CareerPromotionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ManagementUserController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
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

// Route berfungsi untuk mengakses url yang dapat di akses di internet

// login
Route::get('/', [LoginController::class, 'showLoginForm'])->middleware('guest')->name('login');
Route::post('/', [LoginController::class, 'login'])->middleware('guest');
// register
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->middleware('guest')->name('register');
Route::post('/register', [RegisterController::class, 'register'])->middleware('guest')->name('register');



Route::prefix('/dashboard')->middleware('auth')->group(function () {
    // dashboard
    Route::get('', [DashboardController::class, 'index']);

    // profile
    Route::get('profile', [ProfileController::class, 'index']);
    Route::put('profile/{id}', [ProfileController::class, 'update']);
    Route::get('profile/changepassword', [ProfileController::class, 'updatepassword']);
    Route::put('profile/changepassword/{id}', [ProfileController::class, 'changepassword']);

    // Position
    Route::resource('position', PositionController::class);

    // Management User
    Route::resource('users', ManagementUserController::class);

    // Career Advancement 
    Route::get('career', [CareerPromotionController::class, 'index']);
    Route::post('career', [CareerPromotionController::class, 'store']);

    // logout
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});




// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
