<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminDashboard\BookController;
use App\Http\Controllers\UserDashoard\BorrowingController;
use App\Http\Controllers\AdminDashboard\ReportController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


// Start guest routes
Route::middleware(['api'])->group(function () {
    // Auth
    Route::post('register', [AuthController::class, 'register'])->name('register');
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    // home
    Route::get('books', [BookController::class, 'index'])->name('books');
});
// End guest routes


// Start User routes
Route::middleware(['auth:api', 'user'])->group(function () {
    Route::post('borrow', [BorrowingController::class, 'borrow'])->name('borrow');
    Route::post('return', [BorrowingController::class, 'return'])->name('return');
    Route::post('borrow/history', [BorrowingController::class, 'borrowHistory'])->name('borrow.history');
});
// End User routes

// Start Admin routes

Route::middleware(['auth:api', 'admin'])->group(function () {
    // books routes
    Route::post('books', [BookController::class, 'store'])->name('book.store');
    Route::put('books/{id}', [BookController::class, 'update'])->name('book.update');
    Route::delete('books/{id}', [BookController::class, 'delete'])->name('book.delete');

    // reports route
    Route::get('reports/borrowed', [ReportController::class, 'borrowedReport'])->name('reports.borrow');
    Route::get('reports/popular', [ReportController::class, 'popularReport'])->name('reports.popular');
});
// End Admin routes
