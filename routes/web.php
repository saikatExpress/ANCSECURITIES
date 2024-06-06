<?php

use App\Http\Controllers\admin\AboutController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\BannerController;
use App\Http\Controllers\admin\DepartmentController;
use App\Http\Controllers\admin\DesignationController;
use App\Http\Controllers\admin\FormController;
use App\Http\Controllers\admin\GalleryController;
use App\Http\Controllers\admin\LeaveController;
use App\Http\Controllers\admin\NewsController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\StaffController;
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

Route::get('/', [CompanyController::class, 'welcome']);

Route::controller(CompanyController::class)->group(function(){
    Route::get('/about', 'about')->name('about.us');
    Route::get('/contact', 'contact')->name('contact.us');
    Route::post('/contact/store', 'contactStore')->name('contact.store');
    Route::get('/faq', 'faq')->name('faq.us');
    $hashedNewsreadUrl = md5('news/read');
    Route::get('/'.$hashedNewsreadUrl.'/{id}', 'newsRead')->name('news.read');
    $hashedAllnewsUrl = md5('all/news');
    Route::get('/'.$hashedAllnewsUrl, 'allNews')->name('all.news');
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

Route::middleware(['auth', 'CheckAdmin'])->group(function(){
    Route::controller(AdminController::class)->group(function(){
        $hashedAdminUrl = md5('admin/dashboard');
        Route::get('/'.$hashedAdminUrl, 'index')->name('admin.dashboard');
        $hashedDirectorUrl = md5('create/director');
        Route::get('/'.$hashedDirectorUrl, 'create')->name('director.create');
        $hashedBoUrl = md5('bo/list');
        Route::get('/'.$hashedBoUrl, 'boIndex')->name('bo.list');
        $hashedShowFormUrl = md5('show/form');
        Route::get('/'.$hashedShowFormUrl.'/{id}', 'showForm')->name('show.form');
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

    Route::controller(StaffController::class)->group(function(){
        $hashedStaffIndexUrl = md5('staff/list');
        Route::get('/'.$hashedStaffIndexUrl, 'index')->name('staff.list');
        $hashedStaffUrl = md5('staff/create');
        Route::get('/'.$hashedStaffUrl, 'create')->name('staff.create');
        $hashedAttedanceUrl = md5('staff/attendace');
        Route::get('/'.$hashedAttedanceUrl, 'createAttendance')->name('staff.attendance');
        Route::post('/staff/store', 'store')->name('staff.store');
        Route::post('/attendance/store', 'attendanceStore')->name('attendance.store');
    });

    Route::controller(LeaveController::class)->group(function(){
        $hashedLeaveUrl = md5('leave/list');
        Route::get('/'.$hashedLeaveUrl, 'index')->name('leave.list');
        Route::post('/leave/store', 'store')->name('leave.store');
        Route::post('/leave/update', 'update')->name('leave.update');
        Route::get('/leave/delete/{id}', 'destroy');
    });

    Route::controller(DepartmentController::class)->group(function(){
        $hashedDepartmentUrl = md5('department/list');
        Route::get('/'.$hashedDepartmentUrl, 'index')->name('department.list');
        Route::post('/department/store', 'store')->name('department.store');
        Route::post('/department/update', 'update')->name('department.update');
        Route::get('/department/delete/{id}', 'destroy');
    });

    Route::controller(NewsController::class)->group(function(){
        $hashedNewsUrl = md5('news.list');
        Route::get('/'.$hashedNewsUrl, 'index')->name('news.portal');
        Route::post('/news/store', 'store')->name('news.store');
        Route::get('/news/delete/{id}', 'destroy');
    });

    Route::controller(RoleController::class)->group(function(){
        $hashedRoleUrl = md5('role/list');
        Route::get('/'.$hashedRoleUrl, 'index')->name('role.list');
        $hashedCreateRoleUrl = md5('create/role');
        Route::get('/'.$hashedCreateRoleUrl, 'create')->name('create.role');
        Route::post('/role/store', 'store')->name('role.store');
        Route::get('/get/permissions/{id}', 'fetchPermission');
        Route::get('/role/delete/{id}','destroy');
    });

    Route::controller(DesignationController::class)->group(function(){
        $hashedDesignationUrl = md5('designation/list');
        Route::get('/'.$hashedDesignationUrl, 'index')->name('designation.list');
        Route::post('/designation/store', 'store')->name('designation.store');
        Route::post('/update/designation', 'update')->name('designation.update');
        Route::get('/designation/delete/{id}', 'destroy');
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
