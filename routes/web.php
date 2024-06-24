<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\JenisKendaraanController;
use App\Http\Controllers\PemesanController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\DetailRekapController;
use App\Http\Controllers\PengirimController;
use App\Http\Controllers\PenerimaController;
use App\Http\Controllers\MetodePembayaranController;
use App\Http\Controllers\TandaTerimaController;
use App\Http\Controllers\RekapController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Admin;
use App\Http\Middleware\Owner;
use Illuminate\Support\Facades\Route;
// Route::get('login', function() {
//     return view('auth.login');
// });
Route::get('/', function () {
    return redirect()->route('rekap.index');
});
Route::middleware(['auth'])->group(function () {
    Route::resource('barang', BarangController::class)->middleware(Admin::class);
    Route::resource('jenis_kendaraan', JenisKendaraanController::class)->middleware(Admin::class);
    Route::resource('transaksi', TransaksiController::class)->middleware(Admin::class);
    Route::resource('pemesan', PemesanController::class)->middleware(Admin::class);
    Route::resource('pegawai', PegawaiController::class)->middleware(Admin::class);
    Route::resource('invoice', InvoiceController::class)->middleware(Admin::class);
    Route::resource('bank', BankController::class)->middleware(Admin::class);
    Route::resource('pengirim', PengirimController::class)->middleware(Admin::class);
    Route::resource('penerima', PenerimaController::class)->middleware(Admin::class);
    Route::resource('metode_pembayaran', MetodePembayaranController::class)->middleware(Admin::class);
    Route::resource('tanda_terima', TandaTerimaController::class)->middleware(Admin::class);
    Route::get('/export_invoice', [InvoiceController::class, 'exportToExcel'])->name('invoice.export');
    Route::get('/rekap_penjualan', [RekapController::class, 'index'])->name('rekap.index');
    Route::resource('user', UserController::class)->middleware(Owner::class);
    Route::get('/rekap_tiap_bulan', [RekapController::class, 'indexPerBulan'])->name('monthly.index');
    Route::get('/rekap_tiap_tahun', [RekapController::class, 'indexPerTahun'])->name('annually.index');
    Route::get('/rekap_tiap_bulan/{month}', [DetailRekapController::class, 'getInvoiceAndTransactions'])->name('monthly');
    Route::get('/rekap_tiap_tahun/{year}', [DetailRekapController::class, 'getInvoiceAnnually'])->name('annually');
});
