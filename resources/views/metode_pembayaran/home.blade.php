@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Metode Pembayaran</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4>LIST METODE PEMBAYARAN</h4>
                    <div class="card-header-action">
                        <a href="{{ route('metode_pembayaran.create') }}" class="btn btn-primary">Tambah Baru</a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Metode</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($metode_pembayaran)
                                    @foreach ($metode_pembayaran as $mp)
                                        <tr>
                                            <td>{{ $mp->id }}</td>
                                            <td>{{ $mp->nama_metode }}</td>
                                            <td>
                                                <a href="{{ route('metode_pembayaran.edit', ['metode_pembayaran' => $mp]) }}" class="btn btn-primary btn-action mr-1" data-toggle="tooltip" title=""
                                                    data-original-title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                                    <form action="{{ route('metode_pembayaran.destroy', ['metode_pembayaran' => $mp]) }}" method="POST" style="display: inline;">
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

