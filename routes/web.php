<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\UsersController;
use App\Http\Middleware\EnsureUserHasRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::middleware([EnsureUserHasRole::class . ':administrator'])->group(function () {

    Route::resource('employees', UsersController::class);

    Route::resource('companies', CompanyController::class);
});
