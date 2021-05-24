@auth('admin')
<ul class="c-sidebar-nav">
    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('admin.beranda') }}">
        <i class="cil-speedometer c-sidebar-nav-icon"></i> Beranda</a>
    </li>
    <li class="c-sidebar-nav-title">Data Pengguna</li>
    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('admin.mahasiswa.index') }}">
        <i class="cil-people c-sidebar-nav-icon"></i> Mahasiswa</a>
    </li>
    <li class="c-sidebar-nav-dropdown"><a class="c-sidebar-nav-dropdown-toggle" href="#">
        <i class="cil-education c-sidebar-nav-icon"></i> Dosen</a>
        <ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item"><a href="{{ route('admin.dosen.index') }}" class="c-sidebar-nav-link">
                Daftar Dosen</a>
            </li>
            <li class="c-sidebar-nav-item"><a href="{{ route('admin.dosen.create') }}" class="c-sidebar-nav-link">
                Tambah Dosen</a>
            </li>
        </ul>
    </li>
</ul>
@elseif(Auth::guard('mahasiswa')->check())
@include('mahasiswa.sidebar')
@elseif(Auth::guard('dosen')->check())
@include('dosen.sidebar')
@endauth
