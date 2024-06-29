@extends('layouts.app')
@section('title', 'Rekap')

@section('content')
<section class="section">
    <div class="section-body">

        <div class="card">

            <div class="card-header">

                <h4> {{$currentYear}} </h4>
                <div class="card-header-action">
                    <a href="{{ route('rekap.export',$monthNumber) }}" class="btn btn-primary">Export</a>
                </div>
            </div>
            <div class="card-body">
                @forelse ($data as $key => $transactions)
                <div class="card-header">
                    <h3>Invoice: {{ $invoices[$key]->nomor_invoice }}</h3>
                </div>
                <div class="card-body">
                    <h6>Pemesan: {{ $invoices[$key]->pemesan->nama_pemesan }} </h6>
                    <h6>Tanggal: {{ $invoices[$key]->tanggal }} </h6>
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th colspan="4">Transaksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="margin-top:2px">
                                <th>Nama Barang</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Sub-Total</th>
                            </tr>
                            @foreach ($transactions as $transaction)
                            <tr>
                                <td> {{ $transaction->nama_barang }} </td>
                                <td> @money($transaction->harga) </td>
                                <td> {{ $transaction->jumlah }} </td>
                                <td> @money($transaction->total) </td>
                            </tr>
                            </td>
                            @endforeach
                            <tr>
                                <td colspan="4" align="right">
                                    <h5>Total : @money($totalHarga[$key]) </h5>
                                </td>
                            </tr>

                        </tbody>

                    </table>
                </div>
                @empty
                <div class="card-header">
                    <h3>Invoice: - </h3>
                </div>
                <div class="card-body">

                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th colspan="4">Transaksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="margin-top:2px">
                                <th>Nama Barang</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Sub-Total</th>
                            </tr>

                            <tr>
                            </tr>
                            </td>
                            <tr>
                                <td colspan="3" align="right">
                                    <h5>Total : - </h5>
                                </td>
                            </tr>

                        </tbody>

                    </table>
                </div>
                @endforelse
            </div>
            <div class="card">
                <div class="card-header">
                    <h2>
                        Total Keseluruhan @money($total)
                    </h2>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
