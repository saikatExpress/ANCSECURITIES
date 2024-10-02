<?php

use App\Http\Controllers\admin\SalaryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\WithdrawController;

Route::controller(WithdrawController::class)->group(function(){

});

Route::middleware(['auth'])->group(function(){
    Route::prefix('admin')->group(function(){
        Route::controller(WithdrawController::class)->group(function(){
            Route::get('/withdraw/list', 'index')->name('admin.withdrawlist');
            Route::get('/withdraw/request', 'create')->name('admin.withdrawrequest');
            Route::post('/withdraw/update', 'update')->name('admin.withdrawupdate');
            Route::post('/withdraw/request', 'store')->name('admin.withdraw_request');
            Route::get('/view/withdraw/request/{id}', 'show')->name('admin.viewwithdrawrequest');
            Route::get('/fetch/withdraw/info/{id}', 'fetchRequestInfo');
        });
    });

    Route::prefix('employee')->group(function(){
        Route::controller(SalaryController::class)->group(function(){
            Route::get('/salary', 'create')->name('employee.salary');
            Route::post('/salary/store', 'store')->name('employee.salarystore');
        });
    });

    Route::controller(WithdrawController::class)->group(function(){
        Route::get('/withdraw/request', 'withdrawIndex')->name('withdraw.request');
    });
});
