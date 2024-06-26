<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="{{route('rekap.index')}}">REKAP</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="{{route('rekap.index')}}">RK</a>
    </div>
    <ul class="sidebar-menu">

        @section('sidebar')
        <li class="menu-header">Dashboard</li>
        <li class="nav-item dropdown">
            <a href="{{route('rekap.index')}}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
        </li>

        @can('is-admin')

        <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Tabel
                    Master
                </span></a>
            <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{route('barang.index')}}">Barang</a></li>
                <li><a class="nav-link" href="{{route('jenis_kendaraan.index')}}">Jenis Kendaraan</a></li>
                <li><a class="nav-link" href="{{route('pegawai.index')}}">Pegawai</a></li>
                <li><a class="nav-link" href="{{route('pemesan.index')}}">Pemesan</a></li>
                <li><a class="nav-link" href="{{route('penerima.index')}}">Penerima</a></li>
                <li><a class="nav-link" href="{{route('bank.index')}}">Bank</a></li>
                <li><a class="nav-link" href="{{route('pengirim.index')}}">Pengirim</a></li>
            </ul>
        </li>
        <li class="nav-item dropdown">
            <a href="{{route('invoice.index')}}" class="nav-link"><i class="fas fa-columns"></i>
                <span>Invoice</span></a>
        </li>
        @endcan
        <ul class="dropdown-menu">

        </ul>
        @can('is-owner')
        <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                <span>Histori
                    Rekap </span></a>
            <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ route('monthly.index') }}">Bulanan</a></li>
                <li><a class="nav-link" href="{{ route('annually.index') }}">Tahunan</a></li>
            </ul>
        </li>
        <li class="nav-item dropdown">
            <a href="{{ route('user.index') }}" class="nav-link"><i class="fas fa-columns"></i>
                <span>Users</span></a>
        </li>
        @endcan
        @can('index-users')
        <li class="nav-item dropdown">
            <a href="#" class="nav-link"><i class="fas fa-table"></i><span>User List</span></a>
        </li>
        @endcan
        @show


    </ul>
</aside>
