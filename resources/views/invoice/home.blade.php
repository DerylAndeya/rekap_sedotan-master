@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Invoice</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4>LIST INVOICE</h4>
                    <div class="card-header-action">
                        <a href="{{ route('invoice.create') }}" class="btn btn-primary">Tambah Baru</a>
                        <a href="{{ route('invoice.export') }}" class="btn btn-primary">Export</a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>Nomor</th>
                                    <th>Tanggal</th>
                                    <th>Metode</th>
                                    <th>Bank</th>
                                    <th>Pegawai</th>
                                    <th>Pemesan </th>
                                    <th>Action</th>
                                    <th>Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($invoice)
                                    @foreach ($invoice as $i)
                                        <tr>
                                            <td>{{ $i->nomor_invoice }}</td>
                                            <td>{{ $i->tanggal}}</td>
                                            <td>{{ $i->metode_pembayaran->nama_metode }}</td>
                                            <td>{{ $i->bank->nama_bank }}</td>
                                            <td>{{ $i->pegawai->name }}</td>
                                            <td>{{ $i->pemesan->nama_pemesan }}</td>
                                            <td>
                                                <a href="{{ route('invoice.edit', ['invoice' => $i]) }}" class="btn btn-primary btn-action mr-1" data-toggle="tooltip" title=""
                                                    data-original-title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                            </td>
                                            <td>
                                                <a href="{{ route('transaksi.index', ['id' => $i->id]) }}" class="btn btn-success btn-action mr-1" data-toggle="tooltip" title=""
                                                    data-original-title="Edit"><i class="fa fa-shopping-basket"></i></a>
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


