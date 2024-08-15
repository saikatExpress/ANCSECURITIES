<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\WithdrawController;

Route::controller(WithdrawController::class)->group(function(){

});

Route::middleware(['auth', 'auth.Admin'])->group(function(){
    Route::prefix('admin')->group(function(){
        Route::controller(WithdrawController::class)->group(function(){
            Route::get('/withdraw/request', 'create')->name('admin.withdrawrequest');
            Route::post('/withdraw/request', 'store')->name('admin.withdraw_request');
        });
    });
});
