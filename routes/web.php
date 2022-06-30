<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataBarangController;
use App\Http\Controllers\DataTransaksiController;
use App\Http\Controllers\HargaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LaporanStockController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PelangganKonfirmasiController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\TransaksiPulsaController;
use App\Http\Controllers\UbahPasswordController;
use App\Models\DetailTransaksiAksesoris;
use App\Models\Operator;
use App\Models\TransaksiPulsa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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
Auth::routes([]);


Route::get('/', [IndexController::class, 'index'])->name('index');
Route::resource('/transaksipulsa', TransaksiPulsaController::class);
// Route::resource('/transaksiaksesoris', DetailTransaksiAksesoris::class);


// admin
Route::prefix('admin')->middleware(['admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::resource('operator', OperatorController::class);
    Route::get('operator/harga', [OperatorController::class, 'getharga'])->name('operator.getharga');
    Route::get('/operator/{action}/{id}', [OperatorController::class, 'actionoperator'])->name('operator.actionoperator');

    Route::resource('pelanggan', PelangganController::class);

    Route::get('/pelanggan/{action}/{id}', [PelangganController::class, 'action'])->name('operator.actionpelanggan');

    Route::post('pelanggan-konfirmasi/{id}', [PelangganController::class, 'konfirmasi'])->name('pelanggan-konfirmasi.konfirmasi');

    Route::get('pelanngan/konfirmasi', [PelangganKonfirmasiController::class, 'index'])->name('pelanggan.konfirmasi');

    Route::get('/delete-konfirmasi/{action}/{id}', [PelangganKonfirmasiController::class, 'action'])->name('pelanggan-delete.delete');

    Route::delete('pelanggan/delete/{id}', [PelangganKonfirmasiController::class, 'delete'])->name('pelanggan.delete');

    Route::resource('laporanstock', LaporanStockController::class);
    // aksesoris
    Route::resource('data_barang', DataBarangController::class);

    Route::get('/data_barang/{action}/{id}', [DataBarangController::class, 'action']);

    Route::resource('data-transaksi', DataTransaksiController::class);

    // laporan
    Route::get('laporan_operator', [LaporanController::class, 'laporan_operator'])->name('laporan.operator');
    // Route::get('laporan_operator', [LaporanController::class, 'show'])->name('show.operator');
    Route::get('laporan_operator/cetak_operator', [LaporanController::class, 'cetak_operator'])->name('cetak.operator');

    Route::get('laporan_operator/download', [LaporanController::class, 'download_operator'])->name('download.operator');

    Route::get('laporan_aksesoris', [LaporanController::class, 'laporan_aksesoris'])->name('laporan.aksesoris');
    Route::get('laporan_aksesoris/cetak_aksesoris', [LaporanController::class, 'cetak_aksesoris'])->name('cetak.aksesoris');
    Route::get('laporan_transaksi/download', [LaporanController::class, 'download_aksesoris'])->name('download.aksesoris');

    // ubah password
    Route::resource('ubah-password', UbahPasswordController::class);
});
