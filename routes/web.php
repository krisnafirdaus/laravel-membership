<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProfileController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['role:admin'])->group(function () {
    Route::resource('valas', 'ValaController');
    Route::resource('customers', 'CustomerController');
    Route::resource('transactions', 'TransactionController');
});

Route::middleware(['role:superadmin'])->group(function () {
    Route::get('all-transactions', 'TransactionController@showAll')->name('transactions.showAll'); // Contoh method untuk menampilkan semua transaksi
    Route::resource('memberships', 'MembershipController')->only(['edit', 'update']); // Hanya edit & update yang diperbolehkan
});

Route::get('/reports/valas/{valasName}', 'ReportController@valasMonthlyReport')->name('reports.valasMonthly');
Route::get('/reports/customers', 'ReportController@customerMembershipReport')->name('reports.customers');
Route::get('/reports/profit', [ReportController::class, 'totalProfitReport'])->name('reports.profit');

require __DIR__.'/auth.php';
