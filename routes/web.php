<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\AdminController;

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
    Route::get('/dashboard-karyawan', [KaryawanController::class, 'showDashboard'])
        ->name('dashboard_karyawan');

    Route::get('/detail-dokumen', [KaryawanController::class, 'detail'])
        ->name('detail_dokumen');

    Route::get('/tambah-dokumen', [KaryawanController::class, 'tambah'])
        ->name('tambah_dokumen');

    Route::post('/tambah-dokumen/simpan-dokumen', [KaryawanController::class, 'simpan'])
        ->name('simpan_dokumen');

    Route::get('/tambah-file/{id_variabel_penilaian}', [KaryawanController::class, 'tambahFile'])
        ->name('tambah_file');

    Route::post('/tambah-file/upload-dokumen/{id_variabel_penilaian}', [KaryawanController::class, 'uploadFile'])
        ->name('upload_dokumen');

    Route::get('/show-dokumen/{id_variabel_penilaian}', [KaryawanController::class, 'showDokumen'])
        ->name('show_dokumen');
    
    Route::get('/show-dokumen/lihat-file/{id_variabel_penilaian}/{nama_dokumen}', [KaryawanController::class, 'lihatFile'])
        ->name('lihat_file');
    
    Route::get('/hapus-dokumen/{id_variabel_penilaian}', [KaryawanController::class, 'delete'])
        ->name('hapus_dokumen');

    Route::post('/hapus-dokumen/konfirm-hapus-dokumen/{id_variabel_penilaian}', [KaryawanController::class, 'konfirmDelete'])
        ->name('konfirm_hapus_dokumen');

    Route::get('/show-profile/{id}', [KaryawanController::class, 'showProfile'])
        ->name('show_profile');

    Route::get('/edit-profile/{id}', [KaryawanController::class, 'editProfile'])
        ->name('edit_profile');
    
    Route::post('/edit-profile/update-profile/{id}', [KaryawanController::class, 'updateProfile'])
        ->name('update_profile');

    Route::get('/edit-data-profile/{id}', [KaryawanController::class, 'editDataProfile'])
        ->name('edit_data_profile');

    Route::post('/edit-data-profile/update-data-profile/{id}', [KaryawanController::class, 'updateDataProfile'])
        ->name('update_data_profile');
    
    Route::get('/pilih-dokumen', [KaryawanController::class, 'pilihDokumen'])
        ->name('pilih_dokumen');

    Route::get('/detail-variabel', [KaryawanController::class, 'detailVariabel'])
        ->name('detail_variabel');

    Route::get('/tambah-variabel', [KaryawanController::class, 'tambahVariabel'])
        ->name('tambah_variabel');

    Route::post('/tambah-variabel/simpan-variabel', [KaryawanController::class, 'simpanVariabel'])
        ->name('simpan_variabel');

    Route::get('/edit-variabel/{id_variabel_penilaian}', [KaryawanController::class, 'editVariabel'])
        ->name('edit_variabel');

    Route::post('/edit-variabel/update-variabel/{id_variabel_penilaian}', [KaryawanController::class, 'updateVariabel'])
        ->name('update_variabel');

    Route::get('/hapus-variabel/{id_variabel_penilaian}', [KaryawanController::class, 'deleteVariabel'])
        ->name('hapus_variabel');

    Route::post('/hapus-variabel/konfirm-hapus-variabel/{id_variabel_penilaian}', [KaryawanController::class, 'konfirmDeleteVariabel'])
        ->name('konfirm_hapus_variabel');

    Route::get('/hapus-file/{id_variabel_penilaian}/{nama_dokumen}', [KaryawanController::class, 'deleteFile'])
        ->name('hapus_file');

    Route::post('/konfirm-hapus-file/{id_variabel_penilaian}/{nama_dokumen}', [KaryawanController::class, 'konfirmDeleteFile'])
        ->name('konfirm_hapus_file');

    Route::get('/detail-file-dokumen', [KaryawanController::class, 'detailFile'])
        ->name('detail_file_dokumen');

    Route::get('/detail-nilai-dokumen', [KaryawanController::class, 'detailNilai'])
        ->name('detail_nilai_dokumen');

    Route::post('/logout', [LoginController::class, 'destroy'])
        ->name('logout');

    Route::get('/sync', [KaryawanController::class, 'sync'])
        ->name('sync');

    // Route::get('/entry_dokumen', [KaryawanController::class, 'createEntry'])
    // ->name('entry_dokumen');

    // Route::post('/entry_dokumen', [KaryawanController::class, 'storeEntry'])
    // ->name('entry_dokumen');

    // Route::get('/entry_dokumen', function () {
    //     return view('karyawan.entry_dokumen');
    // })->name('entry_dokumen');
    
});

Route::group(['middleware' => ['auth', 'level:Admin']], function(){    
    Route::get('/dashboard-admin', [AdminController::class, 'showDashboardAdmin'])
        ->name('dashboard_admin');
    
    Route::get('/detail-dokumen-admin', [AdminController::class, 'detailAdmin'])
        ->name('detail_dokumen_admin');
    
    Route::get('/tambah-file-admin/{id_variabel_penilaian}', [AdminController::class, 'tambahFileAdmin'])
        ->name('tambah_file_admin');

    Route::post('/tambah-file-admin/upload-dokumen-admin/{id_variabel_penilaian}', [AdminController::class, 'uploadFileAdmin'])
        ->name('upload_dokumen_admin');

    Route::get('/show-dokumen-admin/{id_variabel_penilaian}', [AdminController::class, 'showDokumenAdmin'])
        ->name('show_dokumen_admin');
    
    Route::get('/show-dokumen-admin/lihat-file-admin/{id_variabel_penilaian}/{nama_dokumen}', [AdminController::class, 'lihatFileAdmin'])
        ->name('lihat_file_admin');

    Route::get('/show-dokumen-admin/update-status-admin/{id_variabel_penilaian}/{nama_dokumen}', [AdminController::class, 'updateStatus'])
        ->name('update_status_admin');
    
    Route::get('/hapus-dokumen-admin/{id_variabel_penilaian}', [AdminController::class, 'deleteAdmin'])
        ->name('hapus_dokumen_admin');

    Route::post('/hapus-dokumen-admin/konfirm-hapus-dokumen-admin/{id_variabel_penilaian}', [AdminController::class, 'konfirmDeleteAdmin'])
        ->name('konfirm_hapus_dokumen_admin');

    Route::get('/edit-skor-admin/{id_variabel_penilaian}', [AdminController::class, 'editAdmin'])
        ->name('edit_skor_admin');

    Route::post('/edit-skor-admin/update-skor-admin/{id_variabel_penilaian}', [AdminController::class, 'updateAdmin'])
        ->name('update_skor_admin');

    Route::get('/sync', [AdminController::class, 'sync'])
        ->name('sync');

    Route::post('/logout', [LoginController::class, 'destroy'])
        ->name('logout');

    Route::get('/show-profile-admin/{id}', [AdminController::class, 'showProfileAdmin'])
        ->name('show_profile_admin');

    Route::get('/edit-profile-admin/{id}', [AdminController::class, 'editProfileAdmin'])
        ->name('edit_profile_admin');
    
    Route::post('/edit-profile-admin/update-profile-admin/{id}', [AdminController::class, 'updateProfileAdmin'])
        ->name('update_profile_admin');

    Route::get('/edit-data-profile-admin/{id}', [AdminController::class, 'editDataProfileAdmin'])
        ->name('edit_data_profile_admin');

    Route::post('/edit-data-profile-admin/update-data-profile-admin/{id}', [AdminController::class, 'updateDataProfileAdmin'])
        ->name('update_data_profile_admin');

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

Route::get('/detail-perusahaan', function () {
    return view('auth.detail_perusahaan');
})->name('detail_perusahaan')->middleware('auth');

Route::get('/kontak', function () {
    return view('auth.kontak');
})->name('kontak')->middleware('auth');

Route::get('/RTL', function () {
    return view('RTL');
})->name('RTL')->middleware('auth');

// Route::get('/profile', function () {
//     return view('account-pages.profile');
// })->name('profile')->middleware('auth');

Route::get('/signin', function () {
    return view('account-pages.signin');
})->name('signin')->middleware('guest');

Route::get('/signup', function () {
    return view('account-pages.signup');
})->name('signup')->middleware('guest');

Route::get('/sign-up', [RegisterController::class, 'create'])
    ->name('sign-up');

Route::post('/sign-up', [RegisterController::class, 'store']);

Route::get('/sign-in', [LoginController::class, 'create'])
    ->name('sign-in');

Route::post('/sign-in', [LoginController::class, 'store']);

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
