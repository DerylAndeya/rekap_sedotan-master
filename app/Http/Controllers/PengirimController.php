<?php

namespace App\Http\Controllers;

use App\Models\Pengirim;
use App\Http\Requests\StorePengirimRequest;
use App\Http\Requests\UpdatePengirimRequest;
use Illuminate\Http\Request;

class PengirimController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request){

            $data=Pengirim::search($request->search)->paginate(10);
            return view('pengirim/home')->with('items', $data);

        }
        $data = Pengirim::paginate(10);
        return view('pengirim/home')->with('items', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pengirim/form_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated_data=$request->validate([
            'nama_pengirim'=>'required',
        ],[
            'nama_pengirim.required' => 'Nama Pengirim harus diisi'
        ]);
        Pengirim::create($validated_data);

        return redirect()->route('pengirim.index')->with('success','data berhasil disimpan');

    }

    /**
     * Display the specified resource.
     */
    public function show(Pengirim $pengirim)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengirim $pengirim)
    {
        return view('pengirim/form_edit', compact('pengirim'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengirim $pengirim)
    {
        $request->validate([
            'nama_pengirim' => 'required|string|max:255',
        ],[
            'nama_pengirim.required' => 'Nama Pengirim harus diisi'
        ]);


        $pengirim->nama_pengirim = $request->nama_pengirim;
        $pengirim->save();

        return redirect()->route('pengirim.index')->with('success', 'pengirim berhasil diperbarui.');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengirim $pengirim)
    {
        $pengirim->delete();

        return redirect()->route('pengirim.index')->with('success', 'Data pengirim berhasil diperbarui');
    }
}
