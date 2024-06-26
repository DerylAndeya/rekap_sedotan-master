@extends('layouts.app')
@section('title', 'Dashboard')
@section('dynamicRoute')
    {{ route('barang.index') }}
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Penerima</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4>LIST PENERIMA</h4>
                    <div class="card-header-action">
                        <a href="{{ route('penerima.create') }}" class="btn btn-primary">Tambah Baru</a>
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
                                @isset($items)
                                    @foreach ($items as $p)
                                        <tr>
                                            <td>{{ $p->id }}</td>
                                            <td>{{ $p->nama_penerima }}</td>
                                            <td>
                                                <a href="{{ route('penerima.edit', $p) }}" class="btn btn-primary btn-action mr-1" data-toggle="tooltip" title=""
                                                    data-original-title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                                    <form action="{{ route('penerima.destroy', ['penerima' => $p]) }}" method="POST" style="display: inline;">
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

