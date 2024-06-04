<?php

use App\Http\Controllers\admin\AboutController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\BannerController;
use App\Http\Controllers\admin\FormController;
use App\Http\Controllers\admin\GalleryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

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

Route::get('/link', function () {
    Artisan::call('storage:link');
    return 'Storage Link Successfully';
});

Route::get('/clear', function(){
    Artisan::call('optimize:clear');
    return 'Optimize Clear!.';
})->name('clear');

Route::get('/clear-cache', function() {
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return "Cache is cleared";
})->name('clear.cache');

Route::get('/', function () {
    return view('welcome');
});

Route::controller(CompanyController::class)->group(function(){
    Route::get('/about', 'about')->name('about.us');
    Route::get('/contact', 'contact')->name('contact.us');
    Route::get('/faq', 'faq')->name('faq.us');
    Route::get('/gallery', 'gallery')->name('gallery.us');
    Route::get('/board/director', 'boardDirector')->name('board.director');
    Route::get('/online/bo/system', 'onlineBo')->name('online.bo');
    Route::post('/bo/store', 'store')->name('bo.store');
    Route::get('/form/download/{id}', 'formDownload')->name('form.download');
});

Route::controller(AuthController::class)->group(function(){
    $hashedUrl = md5('login');
    Route::get('/' . $hashedUrl, 'login')->name(md5('login'));

    $forpassUrl = md5('forgot/password');
    Route::get('/' . $forpassUrl, 'forgetPassword')->name(md5('forgot.password'));

    $signUp = md5('sign/up');
    Route::get('/' . $signUp, 'signUp')->name('sign.up');

    $hashedSignUpurl = md5('registation/store');
    Route::post('/' . $hashedSignUpurl, 'store')->name('regisation.store');
    Route::post('/log/store', 'logStore')->name('log.store');
});

Route::middleware(['auth'])->group(function(){
    Route::controller(AdminController::class)->group(function(){
        $hashedAdminUrl = md5('admin/dashboard');
        Route::get('/'.$hashedAdminUrl, 'index')->name('admin.dashboard');
    });

    Route::controller(BannerController::class)->group(function(){
        $hashedbannerIndexUrl = md5('banner/list');
        Route::get('/'.$hashedbannerIndexUrl, 'index')->name('banner.list');
        $hashedBannerUrl = md5('create/banner');
        Route::get('/'.$hashedBannerUrl, 'create')->name('create.banner');
        Route::post('/banner/store', 'store')->name('banner.store');
        Route::get('/banner/delete/{id}', 'destroy');
    });

    Route::controller(GalleryController::class)->group(function(){
        $hashedGalleryList = md5('gallery/list');
        Route::get('/'.$hashedGalleryList, 'index')->name('gallary.list');
        Route::post('/gallery/store', 'store')->name('gallery.store');
        Route::get('/gallery/delete/{id}', 'destroy');
    });

    Route::controller(AboutController::class)->group(function(){
        $hashedAboutUrl = md5('create/about');
        Route::get('/'.$hashedAboutUrl, 'create')->name('about.create');
        Route::post('/about/store', 'store')->name('about.store');
    });

    Route::controller(FormController::class)->group(function(){
        $hashedFormIndexUrl = md5('form/list');
        Route::get('/'.$hashedFormIndexUrl, 'index')->name('form.list');
        $hashedFormUrl = md5('create/form');
        Route::get('/'.$hashedFormUrl, 'create')->name('create.form');
        Route::post('/form/store', 'store')->name('form.store');
        Route::get('/get/form/{id}', 'download')->name('get.form');
        Route::get('/form/delete/{id}', 'destroy');
    });
});

Route::get('/logout', [AuthController::class, 'logout'])->name('logout.us');
