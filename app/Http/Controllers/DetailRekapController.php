<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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
        return view('detailrekap.showChoosen', compact('invoices', 'data', 'totalHarga', 'currentYear', 'total','monthNumber'));
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


    public function exportToExcel(Request $request)
    {

        $invoices = Invoice::whereMonth('tanggal', $request->month)->get();

        $spreadsheet = new Spreadsheet();

        $spreadsheet->setActiveSheetIndex(0);
        $sheet = $spreadsheet->getActiveSheet();

        // Set headers
        $sheet->setCellValue('A1', 'Nomor Invoice');
        $sheet->setCellValue('B1', 'Pemesan');
        $sheet->setCellValue('C1', 'Tanggal');
        $sheet->setCellValue('D1', 'Nama Barang');
        $sheet->setCellValue('E1', 'Harga');
        $sheet->setCellValue('F1', 'Jumlah');
        $sheet->setCellValue('G1', 'Sub-Total');
        $sheet->setCellValue('H1', 'Total');

        $row = 2;

        foreach ($invoices as $ivc) {
            $transaksiTiapInvoice = Transaksi::where('fk_kode_invoice', $ivc['id'])->get();
            $total = 0;
            foreach ($transaksiTiapInvoice as $transaksi) {
                $subTotal = $transaksi->jumlah * $transaksi->barang->harga;
                $total += $subTotal;
                $sheet->setCellValue('A' . $row, $ivc->nomor_invoice);
                $sheet->setCellValue('B' . $row, $ivc->pemesan->nama_pemesan);
                $sheet->setCellValue('C' . $row, $ivc->tanggal);
                $sheet->setCellValue('D' . $row, $transaksi->barang->nama_barang);
                $sheet->setCellValue('E' . $row, $transaksi->barang->harga);
                $sheet->setCellValue('F' . $row, $transaksi->jumlah);
                $sheet->setCellValue('G' . $row, $subTotal);
                $sheet->setCellValue('H' . $row, $total);
                $row++;
            }
            $row++;
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $date = date('Y-M');
        $filename = 'InvoiceBulanan_' . $date . '.xlsx';
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        // Create Excel writer
        $writer = new Xlsx($spreadsheet);

        // Save the file to output
        $writer->save('php://output');
    }
}
