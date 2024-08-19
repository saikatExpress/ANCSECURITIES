<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaymentController;

Route::middleware(['auth', 'user.guard'])->group(function(){
    Route::controller(PaymentController::class)->group(function(){
        Route::get('/fund/withdraw', 'fundWithdrawCreate')->name('fund.withdraw');
        Route::get('/deposite/money', 'depositeMoney')->name('deposite.money');
        Route::post('/withdraw/store', 'store')->name('withdraw.store');
        Route::get('/limit/request', 'requestCreate')->name('limit.request');
        Route::post('/deposite/store', 'depositeStore')->name('deposite.store');
        Route::post('/limit/request/store', 'requestStore')->name('limit.request_store');
    });

    Route::controller(UserController::class)->group(function(){
        Route::get('/user/dashboard', 'userDashboard')->name('user.dashboard');
    });

    Route::controller(AjaxController::class)->group(function(){
        Route::get('/cancel/fund/request', 'cancelFundRequest');
        Route::get('/cancel/limit/request/{id}', 'cancelRequest');
    });
});
