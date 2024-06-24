@extends('layouts.app')
@section('title','Dashboard')

@section('content')
    <section class="section">
        <div class="section-header">
        <h1>Form Edit</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                  <h4>Input Text</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('barang.update',  ['barang' => $barang])}}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label>Nama Barang</label>
                            <input type="text" class="form-control" name="nama_barang" value="{{$barang->nama_barang}}">
                        </div>
                        <div class="form-group">
                            <label>Harga</label>
                            <input type="number" min="0" step="1" class="form-control" name="harga" value="{{$barang->harga}}">
                        </div>
                        <button type="submit" class="btn btn-primary col-1">Submit</button>
                        </div>
                    </form>



              </div>


        </div>
    </section>
@endsection


