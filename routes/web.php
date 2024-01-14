<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;

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

Route::get('/', function () {
    return redirect('/sign-in');
});

Route::group(['middleware' => ['auth', 'level:Karyawan']], function(){
    Route::get('/dashboard_karyawan', function () {
        return view('karyawan.dashboard_karyawan');
    })->name('dashboard_karyawan');

    Route::get('/entry_dokumen', function () {
        return view('karyawan.entry_dokumen');
    })->name('entry_dokumen');

    Route::get('/detail_dokumen', function () {
        return view('karyawan.detail_dokumen');
    })->name('detail_dokumen');
});

Route::group(['middleware' => ['auth', 'level:Admin']], function(){    
    Route::get('/dashboard_admin', function () {
        return view('admin.dashboard_admin');
    })->name('dashboard_admin');

    Route::get('/verifikasi_dokumen', function () {
        return view('admin.verifikasi_dokumen');
    })->name('verifikasi_dokumen');

    Route::get('/data_pengguna', function () {
        return view('admin.data_pengguna');
    })->name('data_pengguna');

    Route::get('/pills_home', function () {
        return view('admin.data_pengguna');
    })->name('pills_home');

    Route::get('/pills_profile', function () {
        return view('admin.data_pengguna');
    })->name('pills_profile');
});


Route::get('/RTL', function () {
    return view('RTL');
})->name('RTL')->middleware('auth');

Route::get('/profile', function () {
    return view('account-pages.profile');
})->name('profile')->middleware('auth');

Route::get('/signin', function () {
    return view('account-pages.signin');
})->name('signin');

Route::get('/signup', function () {
    return view('account-pages.signup');
})->name('signup')->middleware('guest');

Route::get('/sign-up', [RegisterController::class, 'create'])
    ->middleware('guest')
    ->name('sign-up');

Route::post('/sign-up', [RegisterController::class, 'store'])
    ->middleware('guest');

Route::get('/sign-in', [LoginController::class, 'create'])
    ->name('sign-in');

Route::post('/sign-in', [LoginController::class, 'store']);

Route::post('/logout', [LoginController::class, 'destroy'])
    ->name('logout');

Route::get('/forgot-password', [ForgotPasswordController::class, 'create'])
    ->middleware('guest')
    ->name('password.request');

Route::post('/forgot-password', [ForgotPasswordController::class, 'store'])
    ->middleware('guest')
    ->name('password.email');

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'create'])
    ->middleware('guest')
    ->name('password.reset');

Route::post('/reset-password', [ResetPasswordController::class, 'store'])
    ->middleware('guest');

Route::get('/laravel-examples/user-profile', [ProfileController::class, 'index'])->name('users.profile')->middleware('auth');
Route::put('/laravel-examples/user-profile/update', [ProfileController::class, 'update'])->name('users.update')->middleware('auth');
Route::get('/laravel-examples/users-management', [UserController::class, 'index'])->name('users-management')->middleware('auth');
