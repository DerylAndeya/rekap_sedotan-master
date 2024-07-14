<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request){

            $data=Barang::search($request->search)->paginate(10);
            return view('barangs/home')->with('items', $data);

        }
        $data = Barang::paginate(10);
        return view('barangs/home')->with('items', $data);
    }

    public function create()
    {
        return view('barangs/form_create'); //}
    }


    public function store(Request $request)
    { //

        $validated_data = $request->validate([
            'nama_barang' => 'required',
            'harga' => 'required',
        ], [
            'nama_barang.required' => 'Nama Barang harus diisi',
            'harga.required' => 'Harga harus diisi',
        ]);

        Barang::create($validated_data);

        return redirect()->route('barang.index')->with('success', 'data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(barang $barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(barang $barang)
    {
        return view('barangs/form_edit', compact('barang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'harga' => 'required|numeric'
        ], [
            'nama_barang.required' => 'Nama Barang harus diisi',
            'harga.required' => 'Harga harus diisi',
        ]);


        $barang->nama_barang = $request->nama_barang;
        $barang->harga = $request->harga;

        $barang->save();

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barang $barang)
{
    $barang->delete();

    return redirect()->route('barang.index')->with('success', 'Data barang berhasil diperbarui');
}

}
