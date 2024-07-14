@extends('layouts.app')
@section('title','Dashboard')

@section('content')
    <section class="section">
        <div class="section-header">
        <h1>Form Edit Pengirim</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card">
                    <div class="back"></br><button type="button" class="btn btn-primary ml-2" onclick="window.location.href='{{ route('pengirim.index') }}'">Back</button>
                        </div>
                <div class="card-header">
                  <h4>Input Text</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('pengirim.update', $pengirim)}}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label>Pengirim</label>
                            <input type="text" class="form-control @error('nama_pengirim') is-invalid @enderror" name="nama_pengirim" value="{{$pengirim->nama_pengirim}}">
                            @error('nama_pengirim')
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


