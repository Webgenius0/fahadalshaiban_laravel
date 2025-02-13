<?php

use App\Http\Controllers\Web\Client\OrderController;
use App\Http\Controllers\Web\Owner\DashboardController;
use App\Http\Controllers\Web\Owner\OrderListController;
use App\Http\Controllers\Web\Owner\PageController;
use App\Http\Controllers\Web\Owner\SignageController;
use App\Models\Order;
use Illuminate\Support\Facades\Route;

Route::controller(DashboardController::class)->group(function () {
    Route::get('dashboard', 'index')->name('dashboard');
});

Route::controller(PageController::class)->group(function () {
    Route::get('/page/tutorials', 'tutorials')->name('page.tutorials');
    Route::get('page/add/signage', 'signage')->name('page.add.signage');
    Route::get('page/income/statement', 'incomeStatement')->name('page.income.statement');
    Route::get('page/profile', 'profile')->name('page.profile');
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