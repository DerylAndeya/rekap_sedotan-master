@extends('layouts.app')
@section('title','Dashboard')

@section('content')
    <section class="section">
        <div class="section-header">
        <h1>Form Bank</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="back ml-3"></br><button type="button" class="btn btn-primary ml-2" onclick="window.location.href='{{ route('bank.index') }}'">Back</button>
                    </div>
                <div class="card-header">
                  <h4>Input Text</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('bank.store')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Nama Bank</label>
                            <input type="text" class="form-control @error('nama_bank') is-invalid @enderror" name="nama_bank" value="{{ old('nama_bank') }}">
                            @error('nama_bank')
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
