<?php

use App\Http\Controllers\admin\WithdrawController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'CheckAdmin'])->group(function(){
    Route::prefix('withdraw')->group(function(){
        Route::controller(WithdrawController::class)->group(function(){

            Route::get('/req/list', 'index')->name('admin.withdrawlist')->middleware('can:withdraw list');
            Route::get('/deleted/request', 'deletedRequest')->name('withdrawdeletedrequest');

            Route::get('/create', 'create')->name('admin.withdrawrequest')->middleware('can:create withdraw');
            Route::post('/req/store', 'store')->name('withdrawrequeststore')->middleware('can:create withdraw');
            Route::post('/request/{id}', 'requestWithdraw')->name('request.withdraw')->middleware('can:edit withdraw');
            Route::get('/manual/request', 'manuelRequest')->name('manual.request')->middleware('can:manual request');
            Route::post('/upgrade/status', 'upgradeWithdrawStatus');
            Route::get('/get/status/{id}', 'withdrawStatus');
            Route::get('/req/delete/{id}', 'destroy')->middleware('can:delete withdraw');
        });
    });
});