<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RedircetController;
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

Route::get('/listpackage', [\App\Http\Controllers\Landing\IndexController::class, 'list_package'])->name('list_package');
Route::get('/themelist', [\App\Http\Controllers\Landing\IndexController::class, 'list_theme'])->name('list_theme');
Route::get('/detail', [\App\Http\Controllers\Landing\IndexController::class, 'detail']);

// Route::get('/', [\App\Http\Controllers\Landing\IndexController::class, 'index']);

Route::get('/', [AuthController::class, 'login'])->name('login');

//  jika user belum login
Route::group(['middleware' => 'guest'], function () {

    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'save_register']);
    // Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'dologin']);
    
    Route::get('/forgetpasssword/user', [AuthController::class, 'forgetpassword'])->name('forgetpassword.user');
    Route::post('/forgotpassword', [AuthController::class, 'sendEmail'])->name('forgotpassword');
});

// untuk superadmin dan agent dan vendor
Route::group(['middleware' => ['auth', 'checkrole:1,2']], function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/redirect', [RedircetController::class, 'cek']);
});


// untuk superadmin
Route::group(['middleware' => ['auth', 'checkrole:1']], function () {
    Route::get('/admin', [\App\Http\Controllers\Admin\DashboardController::class, 'index']);
    Route::resource('/package', \App\Http\Controllers\Admin\PackgeController::class);
    Route::resource('/additional', \App\Http\Controllers\Admin\AddditionalController::class);
    Route::resource('/pasfoto', \App\Http\Controllers\Admin\PasFotoController::class);
    Route::get('/calender', [\App\Http\Controllers\Admin\CalenderController::class, 'index'])->name('calender');

    Route::get('/calender/load_dates', [\App\Http\Controllers\Admin\CalenderController::class, 'load_dates'])->name('calender.load_dates');
});

// untuk customer
Route::group(['middleware' => ['auth', 'checkrole:2']], function () {
    Route::get('/cabang', [\App\Http\Controllers\Cabang\DashboardController::class, 'index'])->name('cabang.dashboard');
  
});
