@extends('layouts.app')
@section('title','Dashboard')

@section('content')
    <section class="section">
        <div class="section-header">
        <h1>Form Metode Pembayaran</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                  <h4>Input Text</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('metode_pembayaran.update', ['metode_pembayaran' => $metode_pembayaran])}}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label>Nama Metode</label>
                            <input type="text" class="form-control" name="nama_metode" value="{{$metode_pembayaran->nama_metode}}">
                        </div>
                        <button type="submit" class="btn btn-primary col-1">Submit</button>
                        </div>
                    </form>
              </div>
        </div>
    </section>
@endsection


