@extends('layouts.app')
@section('title','Dashboard')

@section('content')
    <section class="section">
        <div class="section-header">
        <h1>Form Penerima</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card">
                    <div class="back"></br><button type="button" class="btn btn-primary ml-2" onclick="window.location.href='{{ route('penerima.index') }}'">Back</button>
                        </div>
                <div class="card-header">
                  <h4>Input Text</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('penerima.store')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Nama Penerima</label>
                            <input type="text" class="form-control @error('nama_penerima') is-invalid @enderror" name="nama_penerima" value="{{ old('nama_penerima') }}">
                            @error('nama_penerima')
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

