<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request){

            $data=Pegawai::search($request->search)->paginate(10);
            return view('pegawai/home')->with('items', $data);

        }
        $data = Pegawai::paginate(10);
        return view('pegawai/home')->with('items', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        return view('pegawai/form_create');//}

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){//

        $validated_data=$request->validate([
            'nama_pegawai'=>'required',
        ]);

        Pegawai::create($validated_data);

        return redirect()->route('pegawai.index')->with('success','data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pegawai $pegawai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pegawai $pegawai)
    {
        return view('pegawai/form_edit', compact('pegawai'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pegawai $pegawai)
    {
        $request->validate([
            'nama_pegawai' => 'required|string|max:255',
        ]);


        $pegawai->nama_pegawai = $request->nama_pegawai;

        $pegawai->save();

        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pegawai $pegawai)
    {
        $pegawai->delete();

        return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil diperbarui');
    }
}
