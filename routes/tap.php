<?php
use App\Http\Controllers\Web\Client\TapPaymentController;
use Illuminate\Support\Facades\Route;


//tap Payment
Route::get('/tap/test', [TapPaymentController::class, 'index']);
Route::get('/create-merchant', [TapPaymentController::class, 'createMerchant'])->name('create.merchant');
Route::get('/create-charge/{order_id}', [TapPaymentController::class, 'createCharge'])->name('create.charge');
Route::get('/payment-callback', [TapPaymentController::class, 'paymentCallback'])->name('payment.callback');
