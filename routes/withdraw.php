<?php

use App\Http\Controllers\admin\WithdrawController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'CheckAdmin'])->group(function(){
    Route::prefix('withdraw')->group(function(){
        Route::controller(WithdrawController::class)->group(function(){
            Route::get('/create', 'create')->name('admin.withdrawrequest')->middleware('can:create withdraw');
        });
    });
});