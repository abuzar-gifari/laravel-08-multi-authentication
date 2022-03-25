<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;


Route::get('/',[FrontendController::class,'index'])->name('frontend.index');

// registration routes
Route::get('registration',[LoginController::class,'registration'])->name('registration');
Route::post('registration',[LoginController::class,'doRegistration']);

//login routes
Route::get('login',[LoginController::class,'login'])->name('login');
Route::post('login',[LoginController::class,'doLogin']);


Route::middleware('auth')->group(function(){
    Route::prefix('admin')->group(function(){
        Route::middleware('isAdmin')->group(function(){
            Route::get('dashboard',[AdminController::class,'index'])->name('admin.dashboard');
            Route::get('logout',[LoginController::class,'doLogout'])->name('logout');
        });
    });
});
