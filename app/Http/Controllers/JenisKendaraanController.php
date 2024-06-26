<?php

namespace App\Http\Controllers;

use App\Models\jenis_kendaraan;
use Illuminate\Http\Request;

class JenisKendaraanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request){

            $data=jenis_kendaraan::search($request->search)->paginate(10);
            return view('jenis_kendaraan/home')->with('items', $data);

        }
        $data = jenis_kendaraan::paginate(10);
        return view('jenis_kendaraan/home')->with('items', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        return view('jenis_kendaraan/form_create');//}


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){//

        $validated_data=$request->validate([
            'nama_jenis'=>'required',
        ]);


        jenis_kendaraan::create($validated_data);

        return redirect()->route('jenis_kendaraan.index')->with('success','data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(jenis_kendaraan $jenis_kendaraan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(jenis_kendaraan $jenis_kendaraan)
    {
        return view('jenis_kendaraan/form_edit', compact('jenis_kendaraan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, jenis_kendaraan $jenis_kendaraan)
    {
        $request->validate([
            'nama_jenis' => 'required|string|max:255',
        ]);


        $jenis_kendaraan->nama_jenis = $request->nama_jenis;
        $jenis_kendaraan->save();

        return redirect()->route('jenis_kendaraan.index')->with('success', 'Kendaraan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(jenis_kendaraan $jenis_kendaraan)
    {
        $jenis_kendaraan->delete();

        return redirect()->route('jenis_kendaraan.index')->with('success', 'Data jenis kendaraan berhasil diperbarui');
    }
}
