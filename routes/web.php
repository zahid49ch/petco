<?php

use App\Http\Controllers\LogoutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HotelLogReportController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SpendsReportController;
use App\Http\Controllers\ClientReportController;
use App\Http\Controllers\CheckInCheckOutController;
use App\Http\Controllers\GroomingTrackingController;
use App\Http\Controllers\UpdateConfirmationController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Home route
Route::get('/', function () {
    return view('welcome');
});


// Authentication routes
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('authenticate');
Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

// Hotel Log Report routes
Route::controller(CheckInCheckOutController::class)->group(function () {
    Route::get('/checkin-checkout/{id}', 'showForm')->name('checkin-checkout.form');
    Route::post('/checkin-checkout/{id}', 'submitForm')->name('checkin-checkout.submit');
    Route::get('/checkin-checkout', 'showForm')->name('checkin-checkout.show');
    Route::get('/bookings', 'showBookings')->name('bookings');
    Route::get('/bookings/edit/{id}', 'showEditForm')->name('checkin-checkout.edit');
});
Route::controller(HotelLogReportController::class)->group(function () {
    Route::get('/hotel_log_report', 'showForm')->name('hotel_log_report.form');
    Route::post('/hotel_log_report', 'handleForm')->name('hotel_log_report.handle');
});

// Report routes
Route::controller(ReportController::class)->group(function () {
    Route::get('/report', 'showForm')->name('report.form');
    Route::post('/report', 'generateReport')->name('report.generate');
});

// Spends Report routes
Route::get('/spends-report', [SpendsReportController::class, 'showForm'])->name('spends-report.form');
Route::post('/spends-report', [SpendsReportController::class, 'generateReport'])->name('spends-report.generate');
Route::post('/spends-store', [SpendsReportController::class, 'store'])->name('spends.store');
Route::get('/create-spend', [SpendsReportController::class, 'showCreateForm'])->name('spends.create');


// Route to handle form submission
Route::post('/spends-store', [SpendsReportController::class, 'store'])->name('spends.store');
Route::get('/spends-report/export-csv', [SpendsReportController::class, 'exportCSV'])->name('spends-report.export-csv');
Route::get('/spends-report/export-pdf', [SpendsReportController::class, 'exportPDF'])->name('spends-report.export-pdf');


// Client Report routes
Route::controller(ClientReportController::class)->group(function () {
    Route::get('/client-report', 'showForm')->name('client-report.form');
    Route::post('/client-report', 'submitReport')->name('client-report.submit');
    Route::get('/client-report/export-csv', [ClientReportController::class, 'exportCSV'])->name('client-report.export-csv');
    Route::get('/client-report/export-pdf', [ClientReportController::class, 'exportPDF'])->name('client-report.export-pdf');
});

// Update Confirmation routes
Route::controller(UpdateConfirmationController::class)->group(function () {
    Route::get('/update-confirmation', 'index')->name('update-confirmation.index');
    Route::post('/update-status/{id}', 'updateStatus')->name('update-status');
});



// Notifications routes
    Route::get('/notifications', [NotificationController::class, 'showForm'])->name('notification.form');
    Route::post('/notifications', [NotificationController::class, 'sendNotification'])->name('notification.send');
    Route::post('/notifications', [NotificationController::class, 'sendNotification'])->name('notification.send');

    Route::get('/update-tracking', [GroomingTrackingController::class, 'showUpdateForm'])->name('show.tracking.form');
    Route::post('/update-tracking', [GroomingTrackingController::class, 'update'])->name('update.tracking');
