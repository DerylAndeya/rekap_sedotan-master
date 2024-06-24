@extends('layouts.app')
@section('title','Dashboard')

@section('content')
    <section class="section">
        <div class="section-header">
        <h1>Form Bank</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                  <h4>Input Text</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('bank.store')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Nama Bank</label>
                            <input type="text" class="form-control" name="nama_bank">
                        </div>
                        <button type="submit" class="btn btn-primary col-1">Submit</button>
                        </div>
                    </form>



              </div>


        </div>
    </section>
@endsection


