<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\WithdrawController;

Route::controller(WithdrawController::class)->group(function(){

});

Route::middleware(['auth', 'auth.Admin'])->group(function(){
    Route::prefix('admin')->group(function(){
        Route::controller(WithdrawController::class)->group(function(){
            Route::get('/withdraw/list', 'index')->name('admin.withdrawlist');
            Route::get('/withdraw/request', 'create')->name('admin.withdrawrequest');
            Route::post('/withdraw/update', 'update')->name('admin.withdrawupdate');
            Route::post('/withdraw/request', 'store')->name('admin.withdraw_request');
            Route::get('/view/withdraw/request/{id}', 'show')->name('admin.viewwithdrawrequest');
        });
    });

    Route::controller(WithdrawController::class)->group(function(){
        Route::get('/withdraw/request', 'withdrawIndex')->name('withdraw.request');
    });
});
