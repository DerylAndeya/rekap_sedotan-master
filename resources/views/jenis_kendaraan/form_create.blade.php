@extends('layouts.app')
@section('title','Dashboard')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Form Jenis Kendaraan</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card">
                    <div class="back ml-3"></br><button type="button" class="btn btn-primary ml-2" onclick="window.location.href='{{ route('jenis_kendaraan.index') }}'">Back</button>
                        </div>
                <div class="card-header">
                    <h4>Input Jenis Kendaraan</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('jenis_kendaraan.store')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Nama Jenis</label>
                            <input type="text" class="form-control @error('nama_jenis') is-invalid @enderror" name="nama_jenis" value="{{ old('nama_jenis') }}">
                            @error('nama_jenis')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary col-1">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
