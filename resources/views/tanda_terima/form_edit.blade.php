@extends('layouts.app')
@section('title','Dashboard')

@section('content')
    <section class="section">
        <div class="section-header">
        <h1>Form Tanda Terima</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                  <h4>Input Text</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('tanda_terima.update', $tanda_terima)}}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label>Kode Invoice</label>
                            <select name="FK_kode_invoice">
                                @forelse ($invoices as $kd)
                                <option value="{{$kd->id}}">
                                {{$kd->kode_invoice}}
                                </option>
                                @empty
                                <option value="" disabled>
                                    Kosong
                                </option>
                                @endforelse
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tanggal</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-calendar"></i>
                                    </div>
                                </div>
                                <input type="text" name="tanggal" value="" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Jenis Kendaraan</label>
                            <select name="FK_jenis_kendaraan">
                                @forelse ($jenis as $j)
                                <option value="{{$kd->id}}">
                                {{$j->nama_jenis}}
                                </option>
                                @empty
                                <option value="" disabled>
                                    Kosong
                                </option>
                                @endforelse
                            </select>
                            </div>
                        <div class="form-group">
                            <label>Plat</label>
                            <input type="text" class="form-control" name="plat">
                        </div>
                        <div class="form-group">
                            <label>Pegawai</label>
                            <select name="FK_pegawai">
                                @forelse ($pegawais as $p)
                                <option value="{{$p->id}}">
                                {{$p->nama_pegawai}}
                                </option>
                                @empty
                                <option value="" disabled>
                                    Kosong
                                </option>
                                @endforelse
                            </select>
                            </div>
                        <div class="form-group">
                            <label>Pengirim</label>
                            <select name="FK_pengirim">
                                @forelse ($peng as $p)
                                <option value="{{$p->id}}">
                                {{$p->nama_pengirim}}
                                </option>
                                @empty
                                <option value="" disabled>
                                    Kosong
                                </option>
                                @endforelse
                            </select>
                            </div>
                        <div class="form-group">
                            <label>Penerima</label>
                            <select name="FK_penerima">
                                @forelse ($pene as $p)
                                <option value="{{$p->id}}">
                                {{$p->nama_penerima}}
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
                    </form>



              </div>


        </div>
    </section>
@endsection


@push('customScript')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script>
        $(function() {
            $('input[name="tanggal"]').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                value:moment(),
                minYear: 2000,
                maxYear: moment().add(1, 'years').year()
            });
        });
    </script>
@endpush
@push('customStyle')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endpush
