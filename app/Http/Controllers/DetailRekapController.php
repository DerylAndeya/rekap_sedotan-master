<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DetailRekapController extends Controller
{
    public static $months = [

        'January', 'February', 'March', 'April', 'May', 'June',
        'July', 'August', 'September', 'October', 'November', 'December'

    ];
    private $currentYear, $threshold;

    public static $monthInNumber = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];

    public function __construct()
    {
        $this->currentYear = Carbon::now()->year;
        $this->threshold = 2024;
    }

    public function getInvoiceAndTransactions($month)
    {
        if (!in_array($month, self::$months)) {
            return redirect()->route('rekap.index');
        }

        $monthNumber = array_search($month, self::$months) + 1;
        $data = [];
        $totalHarga = [];
        $total = 0;

        $invoices = Invoice::where(DB::raw('YEAR(tanggal)'), '=', $this->currentYear)
            ->where(DB::raw('MONTH(tanggal)'), '=', $monthNumber)->orderBy('tanggal', 'asc')->get();

        foreach ($invoices as $key => $invoice) {

            $transactions = DB::table('transaksi')
                ->join('barang', 'barang.id', '=', 'transaksi.fk_kode_barang')
                ->join('invoice', 'invoice.id', '=', 'transaksi.fk_kode_invoice')
                ->select('barang.nama_barang', 'barang.harga', 'transaksi.jumlah', DB::raw('(jumlah * barang.harga) as total'))
                ->where('fk_kode_invoice', '=', $invoice->id)
                ->get();

            foreach ($transactions as $value) {
                $totalHarga[$key] = isset($totalHarga[$key]) ? $totalHarga[$key] + $value->total : $value->total;
                $total += $value->total;
            }

            $data[$key] = $transactions;
        }

        $currentYear = $this->currentYear;
        return view('detailrekap.showChoosen', compact('invoices', 'data', 'totalHarga', 'currentYear', 'total'));
    }

    public function getInvoiceAnnually($year)
    {
        if ($year < $this->threshold) {
            return redirect()->route('rekap.index');
        }

        $data = [];
        $totalHarga = [];
        $total = 0;

        $invoices = Invoice::where(DB::raw('YEAR(tanggal)'), '=', $year)->orderBy('tanggal', 'asc')->get();

        foreach ($invoices as $key => $invoice) {

            $transactions = DB::table('transaksi')
                ->join('barang', 'barang.id', '=', 'transaksi.fk_kode_barang')
                ->join('invoice', 'invoice.id', '=', 'transaksi.fk_kode_invoice')
                ->select('barang.nama_barang', 'barang.harga', 'transaksi.jumlah', DB::raw('(jumlah * barang.harga) as total'))
                ->where('fk_kode_invoice', '=', $invoice->id)
                ->get();

            foreach ($transactions as $value) {
                $totalHarga[$key] = isset($totalHarga[$key]) ? $totalHarga[$key] + $value->total : $value->total;
                $total += $value->total;
            }

            $data[$key] = $transactions;
        }

        $currentYear = $year;
        return view('detailrekap.showChoosen', compact('invoices', 'data', 'totalHarga', 'currentYear', 'total'));
    }
}
