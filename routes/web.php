<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CareerPromotionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LeaveController;
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
    // Management User
    Route::resource('users', ManagementUserController::class);

    // Leave Users
    Route::get('leave/request', [LeaveController::class, 'index']);
    Route::get('leave/request/create', [LeaveController::class, 'create']);
    Route::post('leave/request', [LeaveController::class, 'store']);
    Route::get('leave/request/{id}/edit', [LeaveController::class, 'edit']);
    Route::put('leave/request/{id}', [LeaveController::class, 'update']);
    Route::delete('leave/request/{id}', [LeaveController::class, 'destroy']);

    // Route for hrd dan admin
    Route::middleware('hrd')->group(function () {
        // Confirm leave request user
        Route::get('leave/confirm', [LeaveController::class, 'confirmpage']);
        Route::get('leave/confirm/{id}', [LeaveController::class, 'detailconfirm']);
        Route::put('leave/confirm/{id}', [LeaveController::class, 'confirmrequest']);
    });

    // Route for admin
    Route::middleware('admin')->group(function () {
        // Position
        Route::resource('position', PositionController::class);
        // Career Advancement 
        Route::get('career', [CareerPromotionController::class, 'index']);
        Route::post('career', [CareerPromotionController::class, 'store']);
        // attendance schedule
        Route::get('attendance/schedule', [AttendanceController::class, 'indexSchedule']);
        Route::get('attendance/schedule/create', [AttendanceController::class, 'createSchedule']);
        Route::get('attendance/schedule/{date}/edit', [AttendanceController::class, 'editSchedule']);
        Route::post('attendance/schedule', [AttendanceController::class, 'storeSchedule']);
        Route::put('attendance/schedule/{date}', [AttendanceController::class, 'updateSchedule']);
        Route::delete('attendance/schedule/{date}', [AttendanceController::class, 'deleteSchedule']);
        // Users Attendance
        Route::get('attendance/users', [AttendanceController::class, 'attendanceUser']);
    });



    // check in & check out
    Route::get('attendance/user/check/list', [AttendanceController::class, 'attendanceUserCheckList']);
    Route::post('attendance/user/checkin', [AttendanceController::class, 'checkIn']);
    Route::post('attendance/user/checkout', [AttendanceController::class, 'checkOut']);


    // logout
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});




// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
