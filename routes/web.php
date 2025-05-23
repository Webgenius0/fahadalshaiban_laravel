<?php


use App\Http\Controllers\Web\Frontend\ContactUsController;
use App\Http\Controllers\Web\Frontend\HomeController;
use App\Http\Controllers\Web\Frontend\PageController;
use App\Http\Controllers\Web\LocalizationController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Models\Signage;


use Stichoza\GoogleTranslate\GoogleTranslate;


Route::get('/tn', function () {
    $tr = new GoogleTranslate(session()->get('locale'));
    $text = 'The quick brown fox jumps over the lazy dog.';
    $translatedText = $tr->translate($text);
    return $translatedText;
});



Route::get('/',[HomeController::class, 'index'])->name('home');
Route::get('terms/conditions',[PageController::class, 'termsAndConditions'])->name('terms.conditions');
Route::get('privacy/policy',[PageController::class, 'privacyPolicy'])->name('privacy.policy');
Route::get('refund/policy',[PageController::class, 'refundPolicy'])->name('refund.policy');
Route::get('cookie/policy',[PageController::class, 'cookiePolicy'])->name('cookie.policy');
Route::get('pro/tips',[PageController::class, 'proTips'])->name('pro.tips');
Route::get('join/signage/owner',[PageController::class, 'joinAsSignageOwner'])->name('join.signage.owner');


Route::get('lang/{lang}', [LocalizationController::class, 'set'])->name('lang')->where('lang', 'en|ar');


Route::get('contact/us',[ContactUsController::class, 'index'])->name('contact.us');
Route::post('/store',[ContactUsController::class, 'store'])->name('contactus.store');
// for notification

Route::get('/notifications', [ContactUsController::class, 'notifications'])->name('notifications.fetch');
Route::post('/notifications/{notificationId}/mark-as-read', [ContactUsController::class, 'markNotificationAsRead']);

Route::get('/get-signages', function () {
    return response()->json(Signage::select('id', 'lat', 'lan', 'name')->get());
});



// Routes for running artisan commands
Route::get('/run-migrate-fresh', function () {
    try {
        $output = Artisan::call('migrate:fresh', ['--seed' => true]);
        return response()->json([
            'message' => 'Migrations executed.',
            'output' => nl2br($output)
        ], 200);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'An error occurred while running migrations.',
            'error' => $e->getMessage(),
        ], 500);
    }
});

require __DIR__.'/auth.php';