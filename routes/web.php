<?php

use App\Http\Controllers\admin\AboutController;
use App\Http\Controllers\admin\AccountController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\AttendanceController;
use App\Http\Controllers\admin\BannerController;
use App\Http\Controllers\admin\BoController;
use App\Http\Controllers\admin\DepartmentController;
use App\Http\Controllers\admin\DepositController;
use App\Http\Controllers\admin\DesignationController;
use App\Http\Controllers\admin\DpController;
use App\Http\Controllers\admin\EmployeeController;
use App\Http\Controllers\admin\ExpenseController;
use App\Http\Controllers\admin\FormController;
use App\Http\Controllers\admin\GalleryController;
use App\Http\Controllers\admin\HelperController;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\admin\LeaveController;
use App\Http\Controllers\admin\NewsController;
use App\Http\Controllers\admin\PermissionController;
use App\Http\Controllers\admin\PortfolioController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\ProfileController;
use App\Http\Controllers\admin\ReportController;
use App\Http\Controllers\admin\RequestController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\StaffController;
use App\Http\Controllers\admin\WorkController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\UserController;
use Illuminate\Queue\Console\WorkCommand;
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
    Route::get('/new/bo', 'newBo')->name('new.bo');
    Route::post('/bo/store', 'store')->name('bo.store');
    Route::get('/form/download/{id}', 'formDownload')->name('form.download');
});

Route::controller(AuthController::class)->group(function(){
    $hashedUrl = md5('login');
    Route::get('/' . $hashedUrl, 'login')->name('login');

    $forpassUrl = md5('forgot/password');
    Route::get('/' . $forpassUrl, 'forgetPassword')->name(md5('forgot.password'));

    $signUp = md5('sign/up');
    Route::get('/' . $signUp, 'signUp')->name('sign.up');

    $hashedSignUpurl = md5('registation/store');
    Route::post('/' . $hashedSignUpurl, 'store')->name('regisation.store');
    Route::post('/log/store', 'logStore')->name('log.store');
    Route::get('/get/trade/code/{code}', 'getTradeCode');
    Route::get('/otp/check', 'checkOTP');
    Route::post('/otp/store', 'otpStore')->name('otp.store');
    Route::get('/get/name/check', 'getNameCheck');
    Route::get('/get/email/check', 'getEmailCheck');
    Route::get('/get/mobile/check', 'getMobileCheck');
});

//StatusController for user
Route::controller(StatusController::class)->group(function(){
    Route::get('/user/status', 'create')->name('user.status');
    Route::post('/user/send-otp', 'sendOtp')->name('user.sendOtp');
    Route::post('/user/verify-otp', 'verifyOtp')->name('user.verifyOtp');
});

Route::middleware(['auth'])->group(function(){
    Route::prefix('admin')->group(function(){
        Route::controller(RequestController::class)->group(function(){
            Route::get('/limit/request', 'create')->name('admin.limitrequest');
            Route::post('/limit/store', 'store')->name('admin.limitstore');
            Route::post('/limit/update', 'update')->name('admin.limitupdate');
            Route::post('/update/req/status', 'updateReqStatus')->name('admin.updateReqStatus');
        });
    });

    // Deposite Route
    Route::prefix('deposit')->group(function(){
        Route::controller(DepositController::class)->group(function(){
            Route::get('/', 'create')->name('desposit.request');
            Route::post('/', 'store')->name('deposit.store');
        });
    });

    Route::controller(HelperController::class)->group(function(){
        Route::get('/make/withdraw/file', 'createFile')->name('create.withdrawfile');
        Route::get('/make/withdraw/pdf', 'withdrawPdf')->name('make.withdrawpdf');
        Route::post('/update/dp/status/edit', 'updateStatus')->name('updatedpstatus.edit');
    });
});

// Role Permission Route
Route::middleware(['auth','onlyAdmin'])->group(function(){
    Route::prefix('role')->group(function(){
        Route::controller(RoleController::class)->group(function(){
            Route::get('/', 'index')->name('role.list');
            Route::get('/create', 'create')->name('create.role');
            Route::post('/store', 'store')->name('role.store');
            Route::get('/delete/{id}','destroy')->name('role.destroy');
        });
    });

    Route::prefix('permission')->group(function(){
        Route::controller(PermissionController::class)->group(function(){
            Route::get('/list', 'index')->name('permission.list');
            Route::get('/create', 'create')->name('create.permissions');
            Route::post('/store', 'store')->name('permission.store');
            Route::post('/edit', 'update')->name('permission.edit');
            Route::get('/delete/{id}','destroy')->name('permission.destroy');
        });
    });

    Route::controller(RoleController::class)->group(function(){
        Route::get('/get/permissions/{id}', 'fetchPermission');
        Route::get('/edit-permissions/{role}', 'editPermissions');
        Route::post('/update-permissions/{role}', 'updatePermissions');
    });
});

// User,Client Route
Route::middleware(['auth', 'CheckAdmin'])->group(function(){
    Route::prefix('user')->group(function(){
        Route::controller(HomeController::class)->group(function(){
            Route::get('/list', 'index')->name('user.list');
            Route::get('/active', 'activeUserIndex')->name('active.user');
            Route::get('/create', 'create')->name('create.user');
            Route::post('/store', 'store')->name('user.store');
        });

        Route::controller(UserController::class)->group(function(){
            Route::get('/admin', 'index')->name('admin.list');
            Route::post('/admin/update', 'update')->name('admin.update');
        });
    });
});

Route::middleware(['auth', 'CheckAdmin'])->group(function(){
    Route::controller(AdminController::class)->group(function(){
        $hashedAdminUrl = md5('admin/dashboard');
        Route::get('/'.$hashedAdminUrl, 'index')->name('admin.dashboard');

        $hashedDirectorUrl = md5('create/director');
        Route::get('/'.$hashedDirectorUrl, 'create')->name('director.create');

        $hashedBoUrl = md5('bo/list');
        Route::get('/'.$hashedBoUrl, 'boIndex')->name('bo.list');


        Route::post('/user/update', 'update')->name('user.update');
    });

    Route::prefix('profile')->group(function(){
        Route::controller(ProfileController::class)->group(function(){
            Route::get('/', 'create')->name('profile.us');
            Route::post('/update', 'update')->name('profileupdate')->middleware('can:update profile');
        });
    });


    Route::controller(BoController::class)->group(function(){
        $hashedShowFormUrl = md5('show/form');
        Route::get('/'.$hashedShowFormUrl.'/{id}', 'showForm')->name('show.form');
        Route::get('/create/bo', 'create')->name('create.bo');
        Route::get('/open/bo/form', 'openBoForm')->name('openbo.form');
        Route::post('/store/account', 'acStore')->name('store.bo');
        Route::post('/bo/account/store', 'store')->name('boaccount.store');
        Route::post('/bank/store', 'bankStore')->name('bank.store');
        Route::post('/authorize/store', 'authorizeStore')->name('authorize.store');
        Route::post('/nominee/store', 'nomineeStore')->name('nominee.store');

        Route::post('/upload/bo/image', 'boDocumentupload')->name('upload.image');
        Route::post('/upload/firstholderdriving/image', 'boDocumentfirstPassportupload');
        Route::post('/upload/firstholderdrivingback/image', 'boDocumentfirstPassportBackupload');
        Route::get('/delete/bo/image/{id}', 'boDocumentClear')->name('clear.image');
        Route::get('/delete/firstapplicantpassport/front/image/{id}', 'firstapplicantpassportFrontClear');
        Route::get('/delete/firstapplicantpassport/back/image/{id}', 'firstapplicantpassportBackClear');

        Route::post('/upload-excel','uploadExcel')->name('upload.excel');
    });

    Route::controller(RequestController::class)->group(function(){
        Route::get('/get/client/code/{code}', 'getClientInfo');
        Route::post('/manual/request/store', 'manualStore')->name('manual.request_store');
        Route::get('/deposit/request', 'depositIndex')->name('deposit.request');
        Route::post('/request/toggle/{id}', 'toggleStatus')->name('request.toggle');
        Route::post('/request/deposit/{id}', 'requestDeposit')->name('request.deposit');
        Route::get('/fetch-requests', 'fetchRequests')->name('fetch.requests');
        Route::get('/update/limit/request/{id}', 'updateLimitRequest');
        Route::get('/decline/limit/request/{id}', 'declineLimitRequest');
        Route::get('/fetch-limit-requests', 'fetchLimitRequest')->name('fetch.limit.requests');
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

    Route::controller(PortfolioController::class)->group(function(){
        Route::get('/portfolio/list', 'index')->name('portfolio.list');
        Route::get('/assign/portfolio/list', 'portfolioIndex')->name('assign.portfolio_list');
        Route::get('/create/portfolio', 'create')->name('create.portfolio');
        Route::post('/store/assign/portfolio', 'store')->name('store.portfolio');
        Route::post('/upload-pdfs', 'uploadPDFs');
        Route::get('/assign/portfolio', 'assignPortfolio')->name('assign.portfolio');
        Route::post('/search/clients', 'searchClient')->name('search.clients');
        Route::get('/delete/portfolio', 'destroy')->name('delete.portfolio');
    });

    Route::controller(DpController::class)->group(function(){
        Route::get('/dp/list', 'index')->name('dp.list');
        Route::get('/create/dp', 'create')->name('create.dp');
        Route::post('/dp/store', 'store')->name('dp.store');
    });

    Route::controller(HelperController::class)->group(function(){
        Route::get('/update/withdraw/status/{id}', 'updateReqStatus');
        Route::get('/accept/withdraw/status/{id}', 'acceptReqStatus');
        Route::get('//get/withdraw/info/{id}', 'getWithdrawInfo');

        Route::get('/make/request/pdf/{id}', 'createPdf')->name('makerequest.pdf');

        Route::post('/upload/portfolio', 'uploadPortfolio')->name('upload.portfolio');
        Route::get('/send/remark', 'sendRemark');
    });

    // Staff Route
    Route::prefix('staff')->group(function(){
        Route::controller(StaffController::class)->group(function(){
            Route::get('/list', 'index')->name('staff.list');
            Route::get('/create', 'create')->name('staff.create');
            Route::post('/store', 'store')->name('staff.store');
            Route::get('/edit/{id}', 'edit')->name('staff.edit');
            Route::post('/update', 'update')->name('staff.update');
        });
    });

    // Attendance Route
    Route::prefix('attendace')->group(function(){
        Route::controller(AttendanceController::class)->group(function(){
            Route::get('/create', 'create')->name('staff.attendance');
            Route::post('/store', 'store')->name('attendance.store');
            Route::post('/update/status/{employeeId}', 'updateAttendanceStatus');
            Route::post('/update-all-attendance', 'updateAllAttendance');
            Route::post('/insert', 'empattendanceStore')->name('empattendance.store');
        });
    });

    Route::controller(WorkController::class)->group(function(){
        Route::get('/work/list', 'index')->name('work.list');
        Route::get('/add/work', 'create')->name('add.work');
        Route::post('/work/store', 'store')->name('work.store');
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

    Route::controller(EmployeeController::class)->group(function(){
        Route::post('/employee/work/store', 'workStore')->name('employeework.store');
    });

    Route::controller(NewsController::class)->group(function(){
        $hashedNewsUrl = md5('news.list');
        Route::get('/'.$hashedNewsUrl, 'index')->name('news.portal');
        Route::post('/news/store', 'store')->name('news.store');
        Route::get('/news/delete/{id}', 'destroy');
    });

    Route::controller(ReportController::class)->group(function(){
        Route::get('/attendance/report', 'attendanceReport')->name('attendance.report');
        Route::get('/expense/report', 'expenseReport')->name('expense.report');
        Route::get('/expense/report/download', 'downloadExpenseReport')->name('expense.report.download');
    });

    Route::controller(DesignationController::class)->group(function(){
        $hashedDesignationUrl = md5('designation/list');
        Route::get('/'.$hashedDesignationUrl, 'index')->name('designation.list');
        Route::post('/designation/store', 'store')->name('designation.store');
        Route::post('/update/designation', 'update')->name('designation.update');
        Route::get('/designation/delete/{id}', 'destroy');
    });

    Route::controller(ExpenseController::class)->group(function(){
        Route::get('/expense/list', 'index')->name('expense.list');
        Route::get('/todays/expense', 'todaysExpense')->name('todays.expense');
        Route::get('/create/expense', 'create')->name('create.expense');
        Route::post('/expense/store', 'store')->name('expense.store');
        Route::get('/assign/expense/admin/{id}', 'assignExpenseAdmin')->name('assign.expense');
        Route::get('/expense/edit/{id}', 'edit')->name('expense.edit');
        Route::post('/expense/update', 'update')->name('expense.update');
        Route::post('/update-expense-status', 'updateExpenseStatus')->name('update-expense-status');
        Route::get('/expense/delete/{id}', 'destroy');
    });

    Route::controller(AccountController::class)->group(function(){
        Route::get('/account/balance', 'index')->name('account.balance');
        Route::post('/account/store', 'store')->name('account.store');
    });

    Route::controller(ProductController::class)->group(function(){
        Route::get('/create/product', 'create')->name('create.product');
        Route::post('/product/store', 'store')->name('product.store');
    });

    Route::controller(FormController::class)->group(function(){
        $hashedFormIndexUrl = md5('form/list');
        Route::get('/'.$hashedFormIndexUrl, 'index')->name('form.list');
        $hashedFormUrl = md5('create/form');
        Route::get('/'.$hashedFormUrl, 'create')->name('create.form');
        Route::post('/form/store', 'store')->name('form.store');
        Route::get('/get/form/{id}', 'download')->name('get.form');
        Route::get('/show/test/{id}', 'showTest')->name('show.test');
        Route::get('/form/delete/{id}', 'destroy');
    });

    Route::controller(SettingController::class)->group(function(){
        Route::get('/project/setting', 'create')->name('project.setting');
        Route::post('/setting/update', 'update')->name('setting.update');
        Route::get('/modification', 'modificationCreate')->name('modification');
        Route::post('/update/information', 'updateInformation')->name('update.information');
    });
});

Route::get('/logout', [AuthController::class, 'logout'])->name('logout.us');