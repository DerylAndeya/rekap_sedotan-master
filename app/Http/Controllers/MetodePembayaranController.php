<?php

namespace App\Http\Controllers;

use App\Models\MetodePembayaran;
use App\Http\Requests\StoreMetodePembayaranRequest;
use App\Http\Requests\UpdateMetodePembayaranRequest;
use Illuminate\Http\Request;

class MetodePembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = MetodePembayaran::all();

        return view('metode_pembayaran/home')->with('metode_pembayaran', $data);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('metode_pembayaran/form_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated_data=$request->validate([
            'nama_metode'=>'required',
        ]);

        MetodePembayaran::create($validated_data);

        return redirect()->route('metode_pembayaran.index')->with('success','data berhasil disimpan');

    }

    /**
     * Display the specified resource.
     */
    public function show(MetodePembayaran $metodePembayaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MetodePembayaran $metodePembayaran)
    {
        return view('metode_pembayaran/form_edit', compact('jenis_kendaraan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMetodePembayaranRequest $request, MetodePembayaran $metodePembayaran)
    {
        $request->validate([
            'nama_metode' => 'required|string|max:255',
        ]);


        $metodePembayaran->nama_metode = $request->nama_metode;

        $metodePembayaran->save();

        return redirect()->route('metode_pembayaran.index')->with('success', 'Metode berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MetodePembayaran $metodePembayaran)
    {
        $metodePembayaran->delete();

        return redirect()->route('metode_pembayaran.index')->with('success', 'Data metode pembayaran berhasil diperbarui');
    }
}
