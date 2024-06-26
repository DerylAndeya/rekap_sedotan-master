<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Invoice;
use App\Models\Pegawai;
use App\Models\Pemesan;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function index(Request $request)
     {
         if ($request){

             $data=Invoice::search($request->search)->paginate(10);
             return view('invoice/home')->with('items', $data);

         }
         $data = Invoice::paginate(10);
         return view('invoice/home')->with('items', $data);
     }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bank = Bank::all();
        $pegawai = Pegawai::all();
        $pemesan = Pemesan::all();
        return view('invoice/form_create')->with(['banks' => $bank, 'pegawais' => $pegawai, 'pemesans' => $pemesan]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated_data = $request->validate([
            'tanggal' => 'required|date|date_format:Y-m-d|after_or_equal:' . Carbon::today()->format('Y-m-d'),
            'is_cash' => 'required|boolean',
            'FK_bank' => 'required',
            'FK_pegawai' => 'required',
            'FK_pemesan' => 'required',
        ]);


        $invoice = new Invoice();

        $kode_inv = 'INV' . $validated_data['FK_pemesan'] . date('Ymd') . date('His');

        $invoice['nomor_invoice'] = $kode_inv;

        $invoice->fill($validated_data);

        // dd($invoice);

        $invoice->save();

        return redirect()->route('invoice.index')->with('success', 'data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        $bank = Bank::all();
        $pegawai = Pegawai::all();
        $pemesan = Pemesan::all();
        return view('invoice/form_edit')->with(['invoice' => $invoice, 'banks' => $bank, 'pegawais' => $pegawai, 'pemesans' => $pemesan]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {

        $validatedData = $request->validate([
            'tanggal' => 'required|date|date_format:Y-m-d|after_or_equal:' . Carbon::today()->format('Y-m-d'),
            'is_cash' => 'required|boolean',
            'FK_bank' => 'required|exists:bank,id',
            'FK_pegawai' => 'required|exists:users,id',
            'FK_pemesan' => 'required|exists:pemesan,id',
        ]);

        $invoice->update($validatedData);

        return redirect()->route('invoice.index')->with('success', 'Barang berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        return redirect()->route('invoice.index')->with('success', 'Data invoice berhasil diperbarui');
    }

    public function exportToExcel()
    {
        $users = Invoice::all();

        $spreadsheet = new Spreadsheet();

        // Set active sheet
        $spreadsheet->setActiveSheetIndex(0);
        $sheet = $spreadsheet->getActiveSheet();

        // Set headers
        $sheet->setCellValue('A1', 'Nomor Invoice');
        $sheet->setCellValue('B1', 'Tanggal');
        $sheet->setCellValue('C1', 'Metode Pembayaran');
        $sheet->setCellValue('D1', 'Bank');
        $sheet->setCellValue('E1', 'Pegawai');
        $sheet->setCellValue('F1', 'Pemesan');


        // Populate data
        $row = 2;
        foreach ($users as $user) {
            $sheet->setCellValue('A' . $row, $user->nomor_invoice);
            $sheet->setCellValue('B' . $row, $user->tanggal);
            $sheet->setCellValue('C' . $row, $user->is_cash ? 'Cash' : 'Transfer');
            $sheet->setCellValue('D' . $row, $user->bank['nama_bank']);
            $sheet->setCellValue('E' . $row, $user->pegawai['nama_pegawai']);
            $sheet->setCellValue('F' . $row, $user->pemesan['nama_pemesan']);
            $row++;
        }

        // Set headers for download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $date = date('Y-m-d_H-i-s');
        $filename = 'Invoice_' . $date . '.xlsx';
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        // Create Excel writer
        $writer = new Xlsx($spreadsheet);

        // Save the file to output
        $writer->save('php://output');
    }
}
