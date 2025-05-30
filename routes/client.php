<?php
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Controllers\Web\Client\BillingAddress;
use App\Http\Controllers\Web\Client\BillingAddressController;
use App\Http\Controllers\Web\Client\CampaignDetailsController;
use App\Http\Controllers\Web\Client\DashboardController;
use App\Http\Controllers\Web\Client\InvoiceController;
use App\Http\Controllers\Web\Client\PageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Client\OrderController;
use App\Models\CampaignDetails;
use App\Models\Order;

Route::controller(DashboardController::class)->group(function () {
    Route::get('dashboard', 'index')->name('dashboard');
});

Route::controller(PageController::class)->group(function () {
    Route::get('page/tutorials', 'tutorials')->name('page.tutorials');
    // Route::get('page/invoice-lists', 'invoiceList')->name('page.invoice.list');
    // Route::get('page/invoice', 'invoice')->name('page.invoice');
    Route::get('page/new/campaigns', 'newCampaigns')->name('page.new.campaigns');
    Route::get('page/billing', 'billing')->name('page.billing');
    Route::get('page/cart', 'cart')->name('page.cart');
    Route::get('page/started/form', 'startedForm')->name('page.started.form');
    Route::get('page/profile', 'profile')->name('client.page.profile');
  
    Route::put('/page/profile/update', 'updateProfile')->name('client.page.profile.update');

    Route::get('/get-signage-location/{id}', 'getLocation')->name('page.location');
    //filtering
    Route::get('/signages/filter','filterSignages')->name('filterSignages');
    Route::post('/checkout','checkout')->name('checkout');

    Route::get('/signage-details/{id}', 'showsignageDetails')->name('showsignageDetails');

    //calender

    // Route to get completed orders


});
Route::get('/get-completed-orders', [OrderController::class, 'getCompletedOrders']);

Route::controller(OrderController::class)->group(function () {
    Route::get('/order', 'index')->name('order.index');
    // Route::get('/order/{id}', 'show')->name('order.show');
    // Route::get('/order/{id}/edit', 'edit')->name('order.edit');
    // Route::get('/order/{id}/status', 'status')->name('order.status');
    // Route::post('/order', 'store')->name('order.store');
    // Route::put('/order/{id}', 'update')->name('order.update');
    // Route::delete('/order/{id}', 'destroy')->name('order.destroy');
});
Route::get('/get-booked-dates/{campaignDetailId}', [OrderController::class, 'getBookedDates'])->name('getBookedDates');
Route::get('/get-booking-details/{id}', [CampaignDetailsController::class, 'getBookingDetails'])->name('getBookingDetails');

Route::post('/billing-address', [BillingAddressController::class, 'store'])->name('storeBillingAddress');
Route::get('/page/billing/{orderId}', [BillingAddressController::class, 'showForm']);


Route::get('/redirect', [BillingAddressController::class, 'Redirect'])->name('billing.redirect');
Route::get('/invoice-list',[InvoiceController::class, 'index'])->name('invoice.index');


Route::get('/invoices/{id}', [InvoiceController::class, 'show'])->name('invoices-details.show');
Route::post('/invoices/download', [InvoiceController::class, 'download'])->name('invoices.download');
// Route::get('/invoices/{id}/download', [InvoiceController::class, 'download'])
//      ->name('invoices.download');

Route::get('/orders/{order}/download', [InvoiceController::class, 'download'])
     ->name('orders.download');

     Route::get('/get-all-signages', [DashboardController::class, 'getsignages'])->name('getsignages');
