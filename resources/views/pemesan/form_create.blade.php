@extends('layouts.app')
@section('title','Dashboard')

@section('content')
    <section class="section">
        <div class="section-header">
        <h1>Form Tabel Pemesan</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                  <h4>Input Text</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('pemesan.store')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Nama Pemesan</label>
                            <input type="text" class="form-control" name="nama_pemesan">
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" class="form-control" name="alamat">
                        </div>
                        <div class="form-group">
                            <label>Telepon</label>
                            <input type="text" class="form-control" name="no_telp">
                        </div>
                        <div class="form-group">
                            <label>Kota</label>
                            <input type="text" class="form-control" name="kota">
                        </div>
                        <button type="submit" class="btn btn-primary col-1">Submit</button>
                        </div>
                    </form>
              </div>
        </div>
    </section>
@endsection


