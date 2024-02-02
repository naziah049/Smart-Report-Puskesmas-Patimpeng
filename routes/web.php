<?php

use App\Http\Controllers\DokterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KeluhanController;
use App\Http\Controllers\KonsultasiController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
    return redirect('login');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'is_admin']], function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    Route::resource('akun-dokter', DokterController::class);
    Route::resource('akun-pasien', PasienController::class);
    Route::get('/keluhan-pasien', [KeluhanController::class, 'adminIndex'])->name('keluhan-pasien.index');
    Route::get('/keluhan-pasien/{keluhan}', [KeluhanController::class, 'adminShow'])->name('keluhan-pasien.show');
    Route::get('/keluhan-pasien/{keluhan}/reject', [KeluhanController::class, 'rejectKeluhan'])->name('keluhan-pasien.reject');
    Route::get('/keluhan-pasien/{keluhan}/approve', [KeluhanController::class, 'approveKeluhan'])->name('keluhan-pasien.approve');

    Route::get('/antrian-pasien', [KeluhanController::class, 'antrian'])->name('antrian-pasien.index');
    Route::get('/antrian-pasien/{keluhan}', [KeluhanController::class, 'antrianShow'])->name('antrian-pasien.show');
    Route::post('/antrian-pasien/{keluhan}', [KeluhanController::class, 'storeAntrian'])->name('antrian-pasien.store');

    Route::get('/report-keluhan', [KeluhanController::class, 'reportKeluhan'])->name('report-keluhan.index');
    Route::get('report-keluhahan-export', [KeluhanController::class, 'reportKeluhanExport'])->name('report-keluhahan.export');

    Route::resource('/konsultasi', KonsultasiController::class);
    Route::get('/offline-konsultasi', [KonsultasiController::class, 'offline'])->name('offline-konsultasi.offline');
    Route::get('/konsultasi-offline-showForm/{konsultasiOffline}', [KonsultasiController::class, 'showForm'])->name('konsultasi-offline.showForm');
    Route::post('/nomor-antrian-konsultasi-offline/{konsultasiOffline}', [KonsultasiController::class, 'storeNomorAntrianOffline'])->name('nomor-antrian.konsultasi-offline');
    Route::delete('/konsultasi-offline-destroy/{konsultasiOffline}', [KonsultasiController::class, 'destroyKonsultasiOffline'])->name('konsultasi-offline.destroy');
});

Route::group(['prefix' => 'staff', 'middleware' => ['auth', 'is_staff']], function () {
    Route::get('/staff-dashboard', [HomeController::class, 'index'])->name('staff.dashboard');

    Route::get('/keluhan-masuk', [KeluhanController::class, 'staffIndex'])->name('keluhan-masuk.index');
    Route::get('/keluhan-masuk/{keluhan}', [KeluhanController::class, 'staffShow'])->name('keluhan-masuk.show');
    Route::get('/keluhan-masuk/{keluhan}/parah', [KeluhanController::class, 'parah'])->name('keluhan-masuk.parah');
    Route::post('/keluhan-masuk/{keluhan}/tidak-parah', [KeluhanController::class, 'tidakParah'])->name('keluhan-masuk.tidak-parah');
    Route::get('/konsultasi-stafchat', [KonsultasiController::class, 'stafChat'])->name('konsultasi.stafchat');
    Route::get('/konsultasi-showchat/{konsultasi}', [KonsultasiController::class, 'showChat'])->name('konsultasi.showchat');
    Route::post('/konsultasi-stafkirim', [KonsultasiController::class, 'stafKirim'])->name('konsultasi.stafkirim');

    Route::get('/keluhan-pasien/{keluhan}/reject-dokter', [KeluhanController::class, 'rejectKeluhanDokter'])->name('keluhan-pasien.reject-dokter');
    Route::get('/keluhan-pasien/{keluhan}/approve-dokter', [KeluhanController::class, 'approveKeluhanDokter'])->name('keluhan-pasien.approve-dokter');
});

Route::group(['prefix' => 'pasien', 'middleware' => ['auth', 'is_pasien', 'activation']], function () {
    Route::get('/pasien-dashboard', [HomeController::class, 'index'])->name('pasien.dashboard');
    Route::resource('keluhan', KeluhanController::class);
    Route::get('/keluhan-chat', [KeluhanController::class, 'chat'])->name('keluhan.chat');
    Route::get('/keluhan-online', [KeluhanController::class, 'createOnline'])->name('keluhan.online');
    Route::get('/ajukan-konsultasi', [KonsultasiController::class, 'ajukanKonsultasi'])->name('ajukan.konsultasi');
    Route::get('/ajukan-konsultasi-offline', [KonsultasiController::class, 'ajukanKonsultasiOffline'])->name('ajukan.konsultasi-offline');
    Route::get('/konsultasi-chat/{konsultasi}', [KonsultasiController::class, 'chat'])->name('konsultasi.chat');
    Route::post('/konsultasi-kirim', [KonsultasiController::class, 'kirim'])->name('konsultasi.kirim');
    Route::get('/konsultasi-pilih', [KonsultasiController::class, 'pilih'])->name('konsultasi.pilih');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('waiting', function () {
    return view('waiting');
})->name('waiting');

require __DIR__ . '/auth.php';
