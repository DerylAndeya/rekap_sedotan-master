@extends('layouts.app')
@section('title','Dashboard')

@section('content')
    <section class="section">
        <div class="section-header">
        <h1>Form Edit Pemesan</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card">
                    <div class="back ml-3"></br><button type="button" class="btn btn-primary ml-2" onclick="window.location.href='{{ route('pemesan.index') }}'">Back</button>
                        </div>
                <div class="card-header">
                  <h4>Input Text</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('pemesan.update', $pemesan)}}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label>Nama Pemesan</label>
                            <input type="text" class="form-control @error('nama_pemesan') is-invalid @enderror" name="nama_pemesan" value="{{$pemesan->nama_pemesan}}">
                            @error('nama_pemesan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" value="{{$pemesan->alamat}}">
                            @error('alamat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Telepon</label>
                            <input type="number" class="form-control @error('no_telp') is-invalid @enderror" name="no_telp" value="{{$pemesan->no_telp}}">
                            @error('no_telp')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Kota</label>
                            <input type="text" class="form-control @error('kota') is-invalid @enderror" name="kota" value="{{$pemesan->kota}}">
                            @error('kota')
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


