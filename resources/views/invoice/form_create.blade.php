@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Form Invoice</h1>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Input Text</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('invoice.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Tanggal</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-calendar"></i>
                                </div>
                            </div>

                            <input type="date" class="form-control datepicker" name="tanggal" value="" id="tanggal" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Metode Pembayaran</label>
                        <select name="is_cash" class="form-control select2 select2-hidden-accessible" tabindex="-1"
                            aria-hidden="true" id="isCash">
                            <option value="" selected disabled>Pilih Metode Pembayaran</option>
                            <option value="1">Cash</option>
                            <option value="0">Transfer</option>
                        </select>
                    </div>
                    <div class="form-group" id="bank">
                        <label>Bank</label>
                        <select name="FK_bank" class="form-control select2 select2-hidden-accessible" tabindex="-1"
                            aria-hidden="true">
                            <option value="" selected disabled>Pilih Bank</option>
                            <option value="-" hidden></option>
                            @forelse ($banks as $b)
                            <option value="{{ $b->id }}">
                                {{ $b->nama_bank }}
                            </option>
                            @empty
                            <option value="" disabled>
                                Kosong
                            </option>
                            @endforelse
                        </select>
                    </div>
                    <input type="hidden" name="FK_pegawai" value="{{auth()->user()->id}}">
                    <div class="form-group">
                        <label>Pemesan</label>
                        <select name="FK_pemesan" class="form-control select2 select2-hidden-accessible" tabindex="-1"
                            aria-hidden="true">
                            @forelse ($pemesans as $p)
                            <option value="{{ $p->id }}">
                                {{ $p->nama_pemesan }}
                            </option>
                            @empty
                            <option value="" disabled>
                                Kosong
                            </option>
                            @endforelse
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary col-1">Submit</button>
            </div>

        </div>
        </form>



    </div>


    </div>

</section>
@endsection


@push('customScript')
{{-- <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script> --}}
<script>
    // get value from select option
        $(document).ready(function() {
            $('#bank').hide();
            $('#isCash').on('change', function() {
                var isCash = $(this).val();
                if (isCash == 0) {
                    $('#bank').show();
                } else {
                    $('#bank option[value="1"]').attr('selected', 'selected');
                    $('#bank').hide();
                }
            });
        });
</script>
@endpush
@push('customStyle')
{{--
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" /> --}}

<script src="{{asset('assets/js/page/forms-advanced-forms.js')}}"></script>
<link rel="stylesheet" href="{{ asset('assets/select2/dist/css/select2.min.css') }}">
@endpush
@push('customScript')
<script src="{{ asset('assets/select2/dist/js/select2.full.min.js') }}"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
{{-- <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script> --}}
@endpush
@push('customScript')
<script>
    document.addEventListener('DOMContentLoaded', function() {
            var today = new Date().toISOString().split('T')[0];
            document.getElementById('tanggal').setAttribute('min', today);
        });
</script>
@endpush
