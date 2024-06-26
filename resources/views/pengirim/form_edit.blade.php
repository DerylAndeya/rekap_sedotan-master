@extends('layouts.app')
@section('title','Dashboard')

@section('content')
    <section class="section">
        <div class="section-header">
        <h1>Form Edit Pengirim</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                  <h4>Input Text</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('pengirim.update', $pengirim)}}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label>Pengirim</label>
                            <input type="text" class="form-control" name="nama_pengirim" value="{{$pengirim->nama_pengirim}}">
                        </div>
                        <button type="submit" class="btn btn-primary col-1">Submit</button>
                        </div>
                    </form>



              </div>


        </div>
    </section>
@endsection


