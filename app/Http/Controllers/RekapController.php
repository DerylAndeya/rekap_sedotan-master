<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;
use Carbon\Carbon;

class RekapController extends Controller
{
    private $threshold, $currentYear;

    public function __construct()
    {
        $this->currentYear = date('Y');
        $this->threshold = 2024;
    }

    protected function hitungRekap($countByWhat)
    {

        // Validate the input to ensure it only accepts specific values
        $validInputs = ['Y', 'M', 'D', 'W', 'LY', 'LYM', 'YD', 'LW'];
        if (!in_array($countByWhat, $validInputs)) {
            throw new InvalidArgumentException('Invalid argument. Only "Y", "M", "D", "W", "LY", "LYM", "YD", or "LW" are allowed.');
        }

        // Get the current date components
        $currentMonth = date('m');
        $currentDay = date('Y-m-d');

        // Determine the start date for filtering invoices based on the input
        $invoiceIds = DB::table('invoice');
        switch ($countByWhat) {
            case 'Y':
                // For year, start from January 1st of the current year
                $invoiceIds->where(DB::raw('YEAR(tanggal)'), '=', $this->currentYear);
                break;
            case 'M':
                // For month, start from the 1st of the current month
                $invoiceIds->where(DB::raw('YEAR(tanggal)'), '=', $this->currentYear)
                    ->where(DB::raw('MONTH(tanggal)'), '=', $currentMonth);
                break;
            case 'D':
                // For day, start from the current day
                $invoiceIds->where('tanggal', $currentDay);
                break;
            case 'W':
                // For week, start from the Monday of the current week
                // $startDate = date('Y-m-d', strtotime('monday this week'));
                break;
            case 'LY':
                // For last year, start from January 1st of the previous year
                $invoiceIds->where(DB::raw('YEAR(tanggal)'), '=', $this->currentYear - 1);
                break;
            case 'LYM':
                // For last year's same month, start from the 1st of the same month last year
                $invoiceIds->where(DB::raw('YEAR(tanggal)'), '=', $this->currentYear - 1)
                    ->where(DB::raw('MONTH(tanggal)'), '=', $currentMonth);
                break;
            case 'YD':
                // For yesterday, start from the previous day
                $invoiceIds->where('tanggal', date('Y-m-d', strtotime('-1 day')));
                break;
            case 'LW':
                // For last week, start from the Monday of the previous week
                // $startDate = date('Y-m-d', strtotime('monday last week'));
                break;
        }

        $invoiceIds = $invoiceIds->get()->pluck('id');

        $data = Transaksi::whereIn('FK_kode_invoice', $invoiceIds)->get();


        $totalRevenue = 0;
        foreach ($data as $transaction) {
            $totalRevenue += $transaction->barang->harga * $transaction->jumlah;
        }

        return $totalRevenue;
    }

    public function totalPerMonth()
    {
        $resultsPerMonth = [];


        for ($month = 1; $month <= 12; $month++) {
            $invoices = Invoice::where(DB::raw('YEAR(tanggal)'), '=', $this->currentYear)
                ->where(DB::raw('MONTH(tanggal)'), $month)->get()->pluck('id');

            $transactions = Transaksi::whereIn('FK_kode_invoice', $invoices)->get();
            $total = 0;
            foreach ($transactions as $trans) {
                $total += $trans->jumlah * $trans->barang->harga; // Menghitung total
            }

            $resultsPerMonth[Carbon::create($this->currentYear, $month)->format('F')] = $total;
        }

        return $resultsPerMonth;
    }

    public function totalPerYear()
    {
        $resultsPerYear = [];
        $totalYearly = 0; // Total tahunan

        for ($i = 0; $i < 5; $i++) {
            if ($this->currentYear - $i < $this->threshold) {
                break;
            }
            $currentYear = $this->currentYear - $i; // Mengambil tahun dari tahun sekarang ke belakang

            $totalYearlyByYear = 0; // Total tahunan per tahun

            $invoices = Invoice::where(DB::raw('YEAR(tanggal)'), '=', $currentYear)->get()->pluck('id');
            $transactions = Transaksi::whereIn('FK_kode_invoice', $invoices)->get();
            foreach ($transactions as $t) {
                $totalYearlyByYear += $t->jumlah * $t->barang->harga;
            }

            $resultsPerYear[$currentYear] = $totalYearlyByYear;

            $totalYearly += $totalYearlyByYear; // Menambahkan total tahunan per tahun ke total tahunan
        }

        return $resultsPerYear;
    }
    //
    public function totalOrders()
    {
        return Invoice::where('tanggal', now()->toDateString())->get()->count();
    }

    public function balance()
    {
        $invoiceIds = Invoice::whereDate('tanggal', now()->toDateString())->get()->pluck('id');

        $transaksi = Transaksi::whereIn('FK_kode_invoice', $invoiceIds)->get();
        $totalRevenue = 0;

        foreach ($transaksi as $transaction) {
            $totalRevenue += $transaction->barang->harga * $transaction->jumlah;
        }

        return $totalRevenue;
    }

    public function sales()
    {
        $invoiceIds = Invoice::where('tanggal', now()->toDateString())->get()->pluck('id');

        $transaksi = Transaksi::whereIn('FK_kode_invoice', $invoiceIds)->get();
        $totalSales = 0;

        foreach ($transaksi as $transaction) {
            $totalSales += $transaction->jumlah;
        }
        return $totalSales;
    }


    public function index()
    {

        $year = $this->hitungRekap('Y');

        $month = $this->hitungRekap('M');

        $day = $this->hitungRekap('D');

        $week = $this->hitungRekap('M');

        $lastYear = $this->hitungRekap('LY');

        $lastYearMonth = $this->hitungRekap('LYM');

        $yesterday = $this->hitungRekap('YD');

        $lastWeek = $this->hitungRekap('LW');

        $resultsPerMonth = $this->totalPerMonth();

        $resultsPerYear = $this->totalPerYear();

        $totalRows = $this->totalOrders();

        $totalRevenue = $this->balance();

        $totalSales = $this->sales();


        return view('rekap.dashbord_rekap', [
            'year' => $year,
            'month' => $month,
            'today' => $day,
            'week' => $week,
            'lastYear' => $lastYear,
            'lastYearMonth' => $lastYearMonth,
            'yesterday' => $yesterday,
            'lastWeek' => $lastWeek,
            'resultsPerMonth' => $resultsPerMonth,
            'resultsPerYear' => $resultsPerYear,
            'totalRows' => $totalRows,
            'totalRevenue' => $totalRevenue,
            'totalSales' => $totalSales,
        ]);
    }

    public function indexPerBulan()
    {
        $totalMonthly = $this->totalPerMonth();

        return view('rekap.monthly', compact('totalMonthly'));
    }

    public function indexPerTahun()
    {
        $totalYearly = $this->totalPerYear();

        return view('rekap.annually', compact('totalYearly'));
    }
}
