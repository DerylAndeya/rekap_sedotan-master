@extends('layouts.app')
@section('title','Dashboard')

@section('content')
    <section class="section">
        <div class="section-header">
        <h1>Form Tabel Barang</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card">
                    <div class="back ml-3"></br><button type="button" class="btn btn-primary ml-2" onclick="window.location.href='{{ route('barang.index') }}'">Back</button>
                        </div>
                <div class="card-header">
                  <h4>Input Text</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('barang.store')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Nama Barang</label>
                            <input type="text" class="form-control @error('nama_barang') is-invalid @enderror" name="nama_barang" value="{{ old('nama_barang') }}">
                            @error('nama_barang')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="form-group">
                                <label>Harga (Per Bal)</label>
                                <input type="number" min="0" step="1" class="form-control @error('harga') is-invalid @enderror" name="harga" value="{{ old('harga') }}">
                                @error('harga')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        <button type="submit" class="btn btn-primary col-1 @error('harga') is-invalid @enderror">Submit</button>
                        </div>
                    </form>



              </div>

        </div>
    </section>
@endsection


