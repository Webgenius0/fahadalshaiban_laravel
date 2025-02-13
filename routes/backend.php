<?php

use App\Http\Controllers\Web\Backend\Access\PermissionController;
use App\Http\Controllers\Web\Backend\Access\RoleController;
use App\Http\Controllers\Web\Backend\Access\UserController;
use App\Http\Controllers\Web\Backend\CategoryController;
use App\Http\Controllers\Web\Backend\CMS\AuthPageController;
use App\Http\Controllers\Web\Backend\CMS\Home\HomeAboutController;
use App\Http\Controllers\Web\Backend\CMS\Home\HomeBannerController;
use App\Http\Controllers\Web\Backend\CMS\Home\HomeCardController;
use App\Http\Controllers\Web\Backend\CMS\Home\HomeHeroController;
use App\Http\Controllers\Web\Backend\CMS\Home\HomeMarqueeController;
use App\Http\Controllers\Web\Backend\CMS\Home\HomeTestimonialController;
use App\Http\Controllers\web\Backend\CMS\Tutorial\ClientCampaignController;
use App\Http\Controllers\Web\Backend\DashboardController;
use App\Http\Controllers\Web\Backend\NotificationController;
use App\Http\Controllers\Web\Backend\PageController;
use App\Http\Controllers\Web\Backend\Settings\FirebaseController;
use App\Http\Controllers\Web\Backend\Settings\GoogleMapController;
use App\Http\Controllers\Web\Backend\Settings\MailSettingController;
use App\Http\Controllers\Web\Backend\Settings\ProfileController;
use App\Http\Controllers\Web\Backend\Settings\SettingController;
use App\Http\Controllers\Web\Backend\Settings\SocialController;
use App\Http\Controllers\Web\Backend\Settings\StripeController;
use App\Http\Controllers\Web\Backend\SignageController;
use App\Http\Controllers\Web\Backend\SocialLinkController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Backend\CMS\Tutorial\HomeTutorialController;
use App\Http\Controllers\web\Backend\CMS\Tutorial\IncomeStatementController;
use App\Http\Controllers\Web\Backend\CMS\Tutorial\LoginTutorialController;
use App\Http\Controllers\Web\Backend\SignageRequest\SignageRequestController;
use App\Http\Controllers\Web\Backend\userRequest\UserRequestController;

Route::controller(DashboardController::class)->group(function () {
    Route::get('dashboard', 'index')->name('dashboard');
});

Route::controller(SocialLinkController::class)->prefix('social')->name('social.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::post('/update/{id}', 'update')->name('update');
    Route::delete('/delete/{id}', 'destroy')->name('destroy');
    Route::get('/status/{id}', 'status')->name('status');
});

Route::controller(CategoryController::class)->prefix('category')->name('category.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::post('/update/{id}', 'update')->name('update');
    Route::delete('/delete/{id}', 'destroy')->name('destroy');
    Route::get('/status/{id}', 'status')->name('status');
});

Route::controller(SignageController::class)->prefix('signage')->name('signage.')->group(function () {
    Route::get('/', 'index')->name('index');
    //Route::get('show/{id}', 'show')->name('show');
    Route::get('/status/{id}', 'status')->name('status');
    Route::get('/signage/view/{id}', 'showSignage')->name('view');
});

Route::controller(PageController::class)->prefix('page')->name('page.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::post('/update/{id}', 'update')->name('update');
    Route::delete('/delete/{id}', 'destroy')->name('destroy');
    Route::get('/status/{id}', 'status')->name('status');
});

/*
*settings
*/

//! Route for Profile Settings
Route::controller(ProfileController::class)->group(function () {
    Route::get('setting/profile', 'index')->name('setting.profile.index');
    Route::put('setting/profile/update', 'UpdateProfile')->name('setting.profile.update');
    Route::put('setting/profile/update/Password', 'UpdatePassword')->name('setting.profile.update.Password');
    Route::post('setting/profile/update/Picture', 'UpdateProfilePicture')->name('update.profile.picture');
});

//! Route for Mail Settings
Route::controller(MailSettingController::class)->group(function () {
    Route::get('setting/mail', 'index')->name('setting.mail.index');
    Route::patch('setting/mail', 'update')->name('setting.mail.update');
});

//! Route for Stripe Settings
Route::controller(StripeController::class)->prefix('setting/stripe')->name('setting.stripe.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::patch('/update', 'update')->name('update');
});

//! Route for Firebase Settings
Route::controller(FirebaseController::class)->prefix('setting/firebase')->name('setting.firebase.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::patch('/update', 'update')->name('update');
});

//! Route for Firebase Settings
Route::controller(SocialController::class)->prefix('setting/social')->name('setting.social.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::patch('/update', 'update')->name('update');
});

//! Route for Stripe Settings
Route::controller(SettingController::class)->group(function () {
    Route::get('setting/general', 'index')->name('setting.general.index');
    Route::patch('setting/general', 'update')->name('setting.general.update');
});

//! Route for Google Map Settings
Route::controller(GoogleMapController::class)->group(function () {
    Route::get('setting/google/map', 'index')->name('setting.google.map.index');
    Route::patch('setting/google/map', 'update')->name('setting.google.map.update');
});

//CMS

Route::prefix('cms')->name('cms.')->group(function () {

    Route::controller(AuthPageController::class)->prefix('page/auth')->name('page.auth.')->group(function () {
        Route::get('/section/bg', 'index')->name('section.bg.index');
        Route::patch('/section/bg', 'update')->name('section.bg.update');
    });

    
    Route::controller(HomeBannerController::class)->prefix('home/banner')->name('home.banner.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::put('/update', 'update')->name('update');
    });

    Route::controller(HomeMarqueeController::class)->prefix('home/marquee')->name('home.marquee.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::put('/update', 'update')->name('update');
    });

    Route::controller(HomeCardController::class)->group(function () {
        Route::get('/card', 'index')->name('home.card.index');
        Route::get('/card/create', 'create')->name('home.card.create');
        Route::post('/card', 'store')->name('home.card.store');
        Route::get('/card/{id}', 'show')->name('home.card.show');
        Route::get('/card/{id}/edit', 'edit')->name('home.card.edit');
        Route::patch('/card/{id}', 'update')->name('home.card.update');
        Route::delete('/card/{id}', 'destroy')->name('home.card.destroy');
        Route::get('/card/{id}/status', 'status')->name('home.card.status');   
    });

    Route::controller(HomeAboutController::class)->prefix('home/about')->name('home.about.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::put('/update', 'update')->name('update');
    });

    Route::controller(HomeTestimonialController::class)->group(function () {
        Route::get('/testimonial', 'index')->name('home.testimonial.index');
        Route::get('/testimonial/create', 'create')->name('home.testimonial.create');
        Route::post('/testimonial', 'store')->name('home.testimonial.store');
        Route::get('/testimonial/{id}', 'show')->name('home.testimonial.show');
        Route::get('/testimonial/{id}/edit', 'edit')->name('home.testimonial.edit');
        Route::patch('/testimonial/{id}', 'update')->name('home.testimonial.update');
        Route::delete('/testimonial/{id}', 'destroy')->name('home.testimonial.destroy');
        Route::get('/testimonial/{id}/status', 'status')->name('home.testimonial.status');   
    });

    Route::controller(HomeHeroController::class)->prefix('home/hero')->name('home.hero.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::put('/update', 'update')->name('update');
    });

});

Route::resource('users', UserController::class);
Route::resource('permissions', PermissionController::class);
Route::resource('roles', RoleController::class);
//Users
Route::controller(UserController::class)->prefix('users')->name('users.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/status/{id}', 'status')->name('status');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::patch('/update/{id}', 'update')->name('update');
    Route::get('/new', 'new')->name('new.index');
    Route::get('/ajax/new/count', 'newCount')->name('ajax.new.count');
});

Route::controller(NotificationController::class)->prefix('notification')->name('notification.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('read/single/{id}', 'readSingle')->name('read.single');
    Route::POST('read/all', 'readAll')->name('read.all');
});

//! Route for Tutorial
Route::controller(HomeTutorialController::class)->prefix('tutorial')->name('tutorial.')->group(function () {
    Route::get('/index', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/status/{id}', 'status')->name('status');
    Route::delete('/delete/{id}', 'destroy')->name('destroy');
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::patch('/update/{id}', 'update')->name('update');
});
//! Route for Client  signage Tutorial
Route::controller(ClientCampaignController::class)->prefix('client/tutorial')->name('client.tutorial.')->group(function () {
    Route::get('/index', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/status/{id}', 'status')->name('status');
    Route::delete('/delete/{id}', 'destroy')->name('destroy');
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::patch('/update/{id}', 'update')->name('update');
});

//!Route for login route
Route::controller(LoginTutorialController::class)->prefix('login')->name('login.')->group(function () {
    Route::get('/index', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/status/{id}', 'status')->name('status');
    Route::delete('/delete/{id}', 'destroy')->name('destroy');
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::patch('/update/{id}', 'update')->name('updates');
});

//! Route for INcome Statement
Route::controller(IncomeStatementController::class)->prefix('income')->name('income.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/status/{id}', 'status')->name('status');
    Route::delete('/delete/{id}', 'destroy')->name('destroy');
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::patch('/update/{id}', 'update')->name('update');
});