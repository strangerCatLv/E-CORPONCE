<?php

use App\Http\Controllers\DepartementController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ApprovalRegisterController;
use App\Http\Controllers\AssignTugasController;
use App\Http\Controllers\KopSuratController;
use App\Http\Controllers\KopSuratKeluarController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SuratKeluarController;
use App\Http\Controllers\SuratMasukController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    $data['page_title'] = "Login";
    return view('auth.login', $data);
})->name('user.login');

Route::get('register', [RegisterController::class, 'index'])->name('register');
Route::post('loginPost2', [UserController::class, 'loginPost2'])->name('loginPost2');


Route::middleware('auth:web')->group(function () {
    
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard.index');

    Route::get('approval-list', [ApprovalRegisterController::class, 'notifikasi'])->name('approval-list');
    
    Route::post('approve-register/{id}', [ApprovalRegisterController::class, 'approval'])->name('approve-register');
    Route::post('not-approve-register/{id}', [ApprovalRegisterController::class, 'notApprove'])->name('not-approve-register');
    
    Route::get('kop-surat', [KopSuratController::class, 'index'])->name('kop-surat');
    Route::post('kop-surat-update', [KopSuratController::class, 'update'])->name('kop-surat-update');

    Route::get('surat-masuk', [SuratMasukController::class, 'index'])->name('surat-masuk');
    Route::post('surat-masuk-store', [SuratMasukController::class, 'store'])->name('surat-masuk-store');
    Route::post('update-surat-masuk/{id}', [SuratMasukController::class, 'update'])->name('update-surat-masuk');
    Route::post('verifikasi-surat-masuk/{id}', [SuratMasukController::class, 'verifikasi'])->name('verifikasi-surat-masuk');
    Route::post('disposisi-surat-masuk/{id}', [SuratMasukController::class, 'disposisi'])->name('disposisi-surat-masuk');
    Route::get('delete-surat-masuk/{id}', [SuratMasukController::class, 'destroy'])->name('delete-surat-masuk');
    
    Route::get('surat-disposisi', [SuratMasukController::class, 'indexDisposisi'])->name('surat-disposisi');
    Route::get('print-disposisi/{id}', [SuratMasukController::class, 'printDisposisi'])->name('print-disposisi');
    Route::get('print-disposisi-v2/{id}', [SuratMasukController::class, 'printDisposisiV2'])->name('print-disposisi-v2');
    
    Route::get('surat-keluar', [SuratKeluarController::class, 'index'])->name('surat-keluar');
    Route::get('tambah-surat-keluar', [SuratKeluarController::class, 'create'])->name('tambah-surat-keluar');
    Route::post('store-surat-keluar', [SuratKeluarController::class, 'store'])->name('store-surat-keluar');
    Route::get('edit-surat-keluar/{id}', [SuratKeluarController::class, 'edit'])->name('edit-surat-keluar');
    Route::post('update-surat-keluar/{id}', [SuratKeluarController::class, 'update'])->name('update-surat-keluar');
    Route::get('delete-surat-keluar/{id}', [SuratKeluarController::class, 'destroy'])->name('delete-surat-keluar');
    
    Route::get('terbit-surat-keluar/{id}', [SuratKeluarController::class, 'terbit'])->name('terbit-surat-keluar');
    Route::get('hapus-surat-keluar/{id}', [SuratKeluarController::class, 'hapus'])->name('hapus-surat-keluar');
    Route::get('print-surat-keluar/{id}', [SuratKeluarController::class, 'print'])->name('print-surat-keluar');
    
    Route::get('laporan-surat-masuk', [SuratMasukController::class, 'laporan'])->name('laporan-surat-masuk');
    Route::get('print-laporan-surat-masuk', [SuratMasukController::class, 'Printlaporan'])->name('print-laporan-surat-masuk');

    Route::get('laporan-surat-keluar', [SuratKeluarController::class, 'laporan'])->name('laporan-surat-keluar');
    Route::get('print-laporan-surat-keluar', [SuratKeluarController::class, 'Printlaporan'])->name('print-laporan-surat-keluar');


    Route::get('assign-tugas', [AssignTugasController::class, 'index'])->name('assign-tugas');
    Route::post('assign-tugas-store', [AssignTugasController::class, 'store'])->name('assign-tugas-store');
    Route::post('assign-tugas-update/{id}', [AssignTugasController::class, 'update'])->name('assign-tugas-update');
    Route::get('assign-tugas-destroy/{id}', [AssignTugasController::class, 'destroy'])->name('assign-tugas-destroy');


    Route::get('kop-surat-keluar', [KopSuratKeluarController::class, 'index'])->name('kop-surat-keluar');
    Route::post('kop-surat-keluar-update', [KopSuratKeluarController::class, 'update'])->name('kop-surat-keluar-update');


     Route::get('master-data', function () {
        $data['page_title'] = 'Master Data';
        $data['breadcumb'] = 'Master Data';
        return view('master-data.index', $data);
    })->name('master-data.index');

    Route::resource('departements', DepartementController::class);

    Route::patch('change-password', [UserController::class, 'changePassword'])->name('users.change-password');

    Route::resource('users', UserController::class)->except([
        'show'
    ]);;

    Route::get('user-destroy/{id}', [UserController::class, 'destroy'])->name('user-destroy');

   
    Route::resource('profile', ProfileController::class)->except([
        'show','create', 'store'
    ]);

    Route::patch('change-password-profile', [ProfileController::class, 'changePassword'])->name('profile.change-password');


});

