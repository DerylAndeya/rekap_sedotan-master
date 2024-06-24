<?php

namespace App\Http\Controllers;

use App\Models\TandaTerima;
use App\Http\Requests\StoreTandaTerimaRequest;
use App\Http\Requests\UpdateTandaTerimaRequest;
use App\Models\Invoice;
use App\Models\Jenis_kendaraan;
use App\Models\Pegawai;
use App\Models\Penerima;
use App\Models\Pengirim;
use Illuminate\Http\Request;

class TandaTerimaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = TandaTerima::all();

        return view('tanda_terima/home')->with('tanda_terima', $data);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tanda_terima/form_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated_data=$request->validate([
            'FK_kode_invoice'=>'required',
            'tanggal'=>'required',
            'FK_jenis_kendaraan'=>'required',
            'plat'=>'required',
            'FK_pegawai'=>'required',
            'FK_pengirim'=>'required',
            'FK_penerima'=>'required',
        ]);

        TandaTerima::create($validated_data);

        return redirect()->route('tanda_terima.index')->with('success','data berhasil disimpan');

    }

    /**
     * Display the specified resource.
     */
    public function show(TandaTerima $tandaTerima)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TandaTerima $tandaTerima)
    {
        $invs = Invoice::all();
        $jks = Jenis_kendaraan::all();
        $pgws = Pegawai::all();
        $pgrs = Pengirim::all();
        $pnrs = Penerima::all();
        dd($invs);
        return view('tanda_terima/form_edit')->with(['tanda_terima' => $tandaTerima, 'invoices' => $invs, 'jenis_kendaraans' => $jks, 'pegawais' => $pgws, 'pengirims' => $pgrs, 'penerimas' => $pnrs]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TandaTerima $tandaTerima)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TandaTerima $tandaTerima)
    {
        //
    }
}
