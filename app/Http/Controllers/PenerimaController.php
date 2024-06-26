<?php

namespace App\Http\Controllers;

use App\Models\Penerima;
use App\Http\Requests\StorePenerimaRequest;
use App\Http\Requests\UpdatePenerimaRequest;
use Illuminate\Http\Request;

class PenerimaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request){

            $data=Penerima::search($request->search)->paginate(10);
            return view('penerima/home')->with('items', $data);

        }
        $data = Penerima::paginate(10);
        return view('penerima/home')->with('items', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('penerima/form_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated_data=$request->validate([
            'nama_penerima'=>'required',
        ]);
        Penerima::create($validated_data);

        return redirect()->route('penerima.index')->with('success','data berhasil disimpan');

    }

    /**
     * Display the specified resource.
     */
    public function show(Penerima $penerima)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penerima $penerima)
    {
        return view('penerima/form_edit', compact('penerima'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penerima $penerima)
    {
        $request->validate([
            'nama_penerima' => 'required|string|max:255',
        ]);


        $penerima->nama_penerima = $request->nama_penerima;
        $penerima->save();

        return redirect()->route('penerima.index')->with('success', 'Penerima berhasil diperbarui.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penerima $penerima)
    {
        $penerima->delete();

        return redirect()->route('penerima.index')->with('success', 'Data penerima berhasil diperbarui');
    }
}
