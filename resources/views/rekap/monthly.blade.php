@extends('layouts.app')
@section('title', 'Rekap Per Bulan')

@section('content')
<section class="section">
    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h3>Bulanan</h3>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Bulan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($totalMonthly as $month => $total)
                        <tr>
                            <td><a href="{{ route('monthly', $month) }}">{{ $month }}</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
