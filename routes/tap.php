<?php
use App\Http\Controllers\Web\Client\TapPaymentController;
use Illuminate\Support\Facades\Route;


//tap Payment
Route::get('/create-merchant', [TapPaymentController::class, 'createMerchant'])->name('create.merchant');
Route::post('/create-charge', [TapPaymentController::class, 'createCharge'])->name('create.charge');
Route::get('/payment-callback', [TapPaymentController::class, 'paymentCallback'])->name('payment.callback');
