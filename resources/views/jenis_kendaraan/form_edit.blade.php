@extends('layouts.app')
@section('title','Dashboard')

@section('content')
    <section class="section">
        <div class="section-header">
        <h1>Form Edit Jenis Kendaraan</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card">
                    <div class="back"></br><button type="button" class="btn btn-primary ml-2" onclick="window.location.href='{{ route('jenis_kendaraan.index') }}'">Back</button>
                        </div>
                <div class="card-header">
                  <h4>Input Text</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('jenis_kendaraan.update', ['jenis_kendaraan' => $jenis_kendaraan])}}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label>Nama Jenis</label>
                            <input type="text" class="form-control @error('nama_jenis') is-invalid @enderror" name="nama_nama_jenis" value="{{$jenis_kendaraan->nama_jenis}}">
                            @error('nama_jenis')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary col-1">Submit</button>
                        </div>
                    </form>



              </div>


        </div>
    </section>
@endsection

