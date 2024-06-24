@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Tanda Terima</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4>LIST TANDA TERIMA</h4>
                    <div class="card-header-action">
                        <a href="{{ route('tanda_terima.create') }}" class="btn btn-primary">Tambah Baru</a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Tanggal</th>
                                    <th>Jenis</th>
                                    <th>Plat</th>
                                    <th>Pegawai</th>
                                    <th>Pengirim</th>
                                    <th>Penerima</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($tanda_terima)
                                    @foreach ($tanda_terima as $tt)
                                        <tr>
                                            <td>{{ $tt->FK_kode_invoice }}</td>
                                            <td>{{ $tt->tanggal }}</td>
                                            <td>{{ $tt->FK_jenis_kendaraan }}</td>
                                            <td>{{ $tt->plat }}</td>
                                            <td>{{ $tt->FK_pegawai }}</td>
                                            <td>{{ $tt->FK_pengirim }}</td>
                                            <td>{{ $tt->FK_penerima }}</td>
                                            <td>
                                                <a class="btn btn-primary btn-action mr-1" data-toggle="tooltip" title=""
                                                    data-original-title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                                <a class="btn btn-danger btn-action trigger--fire-modal-1" data-toggle="tooltip"
                                                    title=""
                                                    data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?"
                                                    data-confirm-yes="alert('Deleted')" data-original-title="Delete"><i
                                                        class="fas fa-trash"></i></a>
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

