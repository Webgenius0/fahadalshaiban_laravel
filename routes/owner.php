<?php

use App\Http\Controllers\Web\Owner\IncomeStatementController;
use App\Http\Controllers\Web\Client\OrderController;
use App\Http\Controllers\Web\Owner\DashboardController;
use App\Http\Controllers\Web\Owner\OrderListController;
use App\Http\Controllers\Web\Owner\PageController;
use App\Http\Controllers\Web\Owner\PdfController;
use App\Http\Controllers\Web\Owner\SignageController;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Route;

Route::controller(DashboardController::class)->group(function () {
    Route::get('dashboard', 'index')->name('dashboard');
});

Route::controller(PageController::class)->group(function () {
    Route::get('/page/tutorials', 'tutorials')->name('page.tutorials');
    Route::get('page/add/signage', 'signage')->name('page.add.signage');
    Route::get('page/income/statement', 'incomeStatement')->name('page.income.statement');
    Route::get('page/profile', 'profile')->name('page.profile');
    Route::put('/page/profile/update', 'updateProfile')->name('page.profile.update');
});


Route::controller(SignageController::class)->prefix('signage')->name('signage.')->group(function () {
    /* Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create'); */
    Route::post('/store', 'store')->name('store');
    /* Route::get('/edit/{id}', 'edit')->name('edit');
    Route::post('/update/{id}', 'update')->name('update');
    Route::delete('/delete/{id}', 'destroy')->name('destroy'); */

    Route::get('/billboards/{id}','showDetails')->name('show');
    Route::get('/edit-signage/{id}', 'editSignage')->name('edit');
    Route::PUT('/update/{id}', 'update')->name('update');

});
Route::controller(OrderListController::class)->group(function () {
    Route::get('/order', 'index')->name('order.index');
});
// In routes/web.php or routes/api.php
Route::get('/get-owner-booked-dates/{signageId}', [OrderListController::class, 'getOwnerBookedDates'])->name('getOwnerBookedDates');

Route::get('/income-statement-list',[IncomeStatementController::class,'index'])->name('income-statement-list');
Route::get('/income-statement/{id}', [PdfController::class, 'generateIncomeStatement'])->name('owner.income-statement-pdf');

// all statement download
Route::get('/income-statement/download-all', [PdfController::class, 'downloadAll'])->name('income-statement.downloadAll');