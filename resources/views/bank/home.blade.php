@extends('layouts.app')
@section('title','Dashboard')

@section('content')
    <section class="section">
        <div class="section-header">
        <h1>Tabel Bank</h1>
        </div>

        <div class="section-body">

          <div class="card">
            <div class="card-header">
              <h4>LIST TABEL BANK</h4>
              <div class="card-header-action">
                <a href="{{route('bank.create')}}" class="btn btn-primary">Tambah Baru</a>
              </div>
            </div>
            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table table-striped mb-0">
                  <thead>
                      <tr>
                          <th>ID</th>
                          <th>Nama</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                      @isset($bank)
                          @foreach ($bank as $b)
                              <tr>
                                  <td>{{$b->id}}</td>
                                  <td>{{$b->nama_bank}}</td>
                                  <td>
                                    <a href="{{ route('bank.edit', ['bank' => $b]) }}" class="btn btn-primary btn-action mr-1" data-toggle="tooltip" title="" data-original-title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                    <form action="{{ route('bank.destroy', ['bank' => $b]) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                    </form>
                                    </td>
                              </tr>
                          @endforeach
                      @endisset
                  </tbody>
              </table>

              </div>
            </div>
          </div>

        </div>
    </section>
@endsection

