<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Transaksi;
use App\Models\Barang;
use App\Models\Invoice;
use App\Models\Pemesan;
use Carbon\Carbon;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;

class notaBaruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $nampung= Carbon::now()->toDateString();
        // dd($nampung);

        $newEmptyInvoice = new Invoice();

        $randomNumbers = str_pad(rand(0, 99), 2, '0', STR_PAD_LEFT);

        $randomLetter = chr(rand(65, 90));

        $kode_inv = 'INV' . $randomNumbers . $randomLetter . date('Ymd') . date('His');

        $newEmptyInvoice['nomor_invoice'] = $kode_inv;

        $newEmptyInvoice->save();

        return redirect()->route('nota_baru.edit', ['nota_baru' => $newEmptyInvoice->id]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //

        $invoice = Invoice::find($id);

        $barangs = Barang::all();

        $banks = Bank::all();

        $pemesan = Pemesan::all();
        $data = Transaksi::where('FK_kode_invoice', $id)
            ->get();

        return view('nota_baru/home')->with(['transaksi' => $data,'barangs' => $barangs, 'banks' => $banks, 'pemesans' => $pemesan, 'invoice' => $invoice]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $nota_baru)
    {
        //

        $validated_data = $request->validate([
            'tanggal' => 'required|date|date_format:Y-m-d|after_or_equal:' . Carbon::today()->format('Y-m-d'),
            'is_cash' => 'required|boolean',
            'FK_bank' => 'required',
            'FK_pegawai' => 'required',
            'FK_pemesan' => 'required',
        ]);

        $invoice=Invoice::find($nota_baru);

        $invoice->update($validated_data);

        // dd($request);

        return redirect()->route('nota_baru.edit' ,['nota_baru' => $invoice->id])->with('success', 'data berhasil disimpan');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transaksi = Transaksi::find($id);
        $ids = $transaksi->invoice->id;
        $transaksi->delete();

        return redirect()->route('nota_baru.edit', ['nota_baru' => $ids])->with('success', 'data berhasil disimpan');
    }

    public function userStore(Request $request, String $id)
    {
        $validated_data = $request->validate([
            'nama_pemesan' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'kota' => 'required',
        ]);

        Pemesan::create($validated_data);

        $invoice=Invoice::find($id);

        return redirect()->route('nota_baru.edit' ,['nota_baru' => $invoice])->with('success', 'data berhasil disimpan');
    }

    public function TransactionStore(Request $request)
    {
        $validated_data = $request->validate([
            'FK_kode_invoice' => 'required',
            'FK_kode_barang' => 'required',
            'jumlah' => 'required',
        ]);

        $transaction = Transaksi::where('fk_kode_invoice', '=', $validated_data['FK_kode_invoice'])
            ->where('fk_kode_barang', '=', $validated_data['FK_kode_barang'])->first();
        if ($transaction) {
            $transaction->jumlah += $validated_data['jumlah'];
            $transaction->update();
        } else {
            Transaksi::create($validated_data);
        }

        return redirect()->route('nota_baru.edit', ['nota_baru' => $validated_data['FK_kode_invoice']])->with('success', 'data berhasil disimpan');
    }
}
