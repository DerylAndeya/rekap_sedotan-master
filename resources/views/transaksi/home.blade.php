@extends('layouts.app')
@section('title','Dashboard')

@section('content')
{{-- pop up form --}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Input Pesanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('transaksi.store') }}" method="post"">
              @csrf
              <div class=" form-group">
                    <label>Barang</label>
                    <input type="hidden" name="FK_kode_invoice" value="{{$invoice->id }}">
                    <select name="FK_kode_barang" class="form-control select2 select2-hidden-accessible" tabindex="-1"
                        aria-hidden="true">
                        @forelse ($barangs as $barang)
                        <option value="{{ $barang->id }}">
                            {{ $barang->nama_barang }}
                        </option>
                        @empty
                        <option value="" disabled>
                            Kosong
                        </option>
                        @endforelse
                    </select>
            </div>
            <div class="form-group">
                <label for="message-text" class="col-form-label">Quantity</label>
                <input type="number" min=0 class="form-control" name="jumlah">
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

        </div>
    </div>
</div>
</div>
<section class="section">
    <div class="section-header">
        <h1>Invoice</h1>
        <div class="section-header-breadcrumb">
        </div>
    </div>

    <div class="section-body">
        <div class="invoice">
            <div class="invoice-print">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="invoice-title">
                            <h2>Invoice</h2>
                            <div class="invoice-number">Order #{{ $invoice->nomor_invoice}}</div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <address>
                                    <strong>Billed To:</strong><br>
                                    {{ $invoice->pemesan->nama_pemesan }}<br>
                                    {{ $invoice->pemesan->kota }}, Indonesia<br>
                                </address>
                            </div>
                            <div class="col-md-6 text-md-right">
                                <address>
                                    <strong>Shipped To:</strong><br>
                                    {{ $invoice->pemesan->nama_pemesan }}<br>
                                    {{ $invoice->pemesan->kota }}
                                </address>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <address>
                                    <strong>Payment Method:</strong><br>
                                    {{$invoice->is_cash ? 'Cash' : 'Transfer' }}<br><br>
                                </address>
                            </div>
                            <div class="col-md-6 text-md-right">
                                <address>
                                    <strong>Order Date:</strong><br>
                                    {{$invoice->tanggal}}<br><br>
                                </address>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="section-title">Order Summary</div>

                        {{-- POP UP FORM --}}
                        <p class="section-lead"><button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#exampleModal" data-whatever="">+</button> Add new items</p>

                        {{-- table --}}
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-md">
                                <thead>
                                    <tr>
                                        <th data-width="40">#</th>
                                        <th class="text-center">Item</th>
                                        <th class="text-center">Price</th>
                                        <th class="text-center">Quantity</th>
                                        <th class="text-right">Totals</th>
                                        <th class="text-right">Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $total = 0; @endphp
                                    @isset($transaksi)
                                    @foreach ($transaksi as $index => $t)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td class="text-center">{{ $t->barang->nama_barang }}</td>
                                        <td class="text-center">{{ $t->barang->harga }}</td>
                                        <td class="text-center">{{ $t->jumlah }}</td>
                                        <td class="text-right">{{ $t->jumlah * $t->barang->harga }}</td>
                                        <td class="text-right">
                                            <form action="{{ route('transaksi.destroy', $t) }}" method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this item?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-action"
                                                    data-toggle="tooltip" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>

                                    </tr>
                                    @php $total+=($t->jumlah * $t->barang->harga)@endphp
                                    @endforeach
                                    @endisset
                                </tbody>
                            </table>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-8">
                            </div>
                            <div class="col-lg-4 text-right">
                                <div class="invoice-detail-item">
                                    <div class="invoice-detail-name">Subtotal</div>
                                    <div class="invoice-detail-value">Rp {{$total}} </div>
                                </div>
                                <div class="invoice-detail-item">
                                    <div class="invoice-detail-name">Shipping</div>
                                    <div class="invoice-detail-value">Rp {{ 0 }}</div>
                                </div>
                                <hr class="mt-2 mb-2">
                                <div class="invoice-detail-item">
                                    <div class="invoice-detail-name">Total</div>
                                    <div class="invoice-detail-value invoice-detail-value-lg">Rp {{$total}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        </div>
    </div>

</section>
@endsection


@push('customStyle')

<script src="{{asset('assets/js/page/forms-advanced-forms.js')}}"></script>
<link rel="stylesheet" href="{{ asset('assets/select2/dist/css/select2.min.css') }}">
@endpush
@push('customScript')
<script src="{{ asset('assets/select2/dist/js/select2.full.min.js') }}"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">

@endpush
