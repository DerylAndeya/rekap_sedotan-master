<?php

namespace App\Http\Controllers;

use App\Models\Pemesan;
use Illuminate\Http\Request;

class PemesanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request){

            $data=Pemesan::search($request->search)->paginate(10);
            return view('pemesan/home')->with('items', $data);

        }
        $data = Pemesan::paginate(10);
        return view('pemesan/home')->with('items', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        return view('pemesan/form_create');//}


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){//

        $validated_data=$request->validate([
            'nama_pemesan'=>'required',
            'alamat'=>'required',
            'no_telp'=>'required',
            'kota'=>'required',
        ]);
        Pemesan::create($validated_data);

        return redirect()->route('pemesan.index')->with('success','data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pemesan $pemesan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pemesan $pemesan)
    {
        return view('pemesan/form_edit', compact('pemesan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pemesan $pemesan)
    {
        $request->validate([
            'nama_pemesan' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_telp' => 'required|string|max:255',
            'kota' => 'required|string',
        ]);


        $pemesan->nama_pemesan = $request->nama_pemesan;
        $pemesan->alamat = $request->alamat;
        $pemesan->no_telp = $request->no_telp;
        $pemesan->kota = $request->kota;
        $pemesan->save();

        return redirect()->route('pemesan.index')->with('success', 'Pemesan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pemesan $pemesan)
    {
        $pemesan->delete();

        return redirect()->route('pemesan.index')->with('success', 'Data penerima berhasil diperbarui');
    }
}
