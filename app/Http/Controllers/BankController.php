<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Http\Requests\StoreBankRequest;
use App\Http\Requests\UpdateBankRequest;
use Illuminate\Http\Request;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Bank::all();

        return view('bank/home')->with('bank', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('bank/form_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated_data=$request->validate([
            'nama_bank'=>'required',
        ]);

        Bank::create($validated_data);

        return redirect()->route('bank.index')->with('success','data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Bank $bank){

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bank $bank)
    {
        return view('bank/form_edit', compact('bank'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bank $bank)
    {
        $request->validate([
            'nama_bank' => 'required|string|max:255',
        ]);


        $bank->nama_bank = $request->nama_bank;

        $bank->save();

        return redirect()->route('bank.index')->with('success', 'Bank berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bank $bank)
    {

        $bank->delete();

        return redirect()->route('bank.index')->with('success', 'Data barang berhasil diperbarui');
    }
}
