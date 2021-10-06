<ul class="c-sidebar-nav">
    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('admin.beranda') }}">
        <i class="cil-speedometer c-sidebar-nav-icon"></i> Beranda</a>
    </li>
    <li class="c-sidebar-nav-title">KP & Skripsi</li>
    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('admin.pendaftaran.index') }}">
        <i class="cil-calendar-check c-sidebar-nav-icon"></i> Pendaftaran</a>
    </li>
    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('admin.proposal.index') }}">
        <i class="cil-task c-sidebar-nav-icon"></i> Proposal</a>
    </li>
    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('admin.beranda') }}">
        <i class="cil-briefcase c-sidebar-nav-icon"></i> Sidang</a>
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
    <li class="c-sidebar-nav-dropdown"><a class="c-sidebar-nav-dropdown-toggle" href="#">
        <i class="cil-money c-sidebar-nav-icon"></i> Keuangan</a>
        <ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item"><a href="{{ route('admin.keuangan.index') }}" class="c-sidebar-nav-link">
                Daftar Petugas</a>
            </li>
            <li class="c-sidebar-nav-item"><a href="{{ route('admin.keuangan.create') }}" class="c-sidebar-nav-link">
                Tambah Petugas</a>
            </li>
        </ul>
    </li>
    <li class="c-sidebar-nav-dropdown"><a class="c-sidebar-nav-dropdown-toggle" href="#">
        <i class="cil-notes c-sidebar-nav-icon"></i> BAAK</a>
        <ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item"><a href="{{ route('admin.baak.index') }}" class="c-sidebar-nav-link">
                Daftar Petugas</a>
            </li>
            <li class="c-sidebar-nav-item"><a href="{{ route('admin.baak.create') }}" class="c-sidebar-nav-link">
                Tambah Petugas</a>
            </li>
        </ul>
    </li>
    <li class="c-sidebar-nav-title">Pengaturan</li>
    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('admin.edit_password') }}">
        <i class="cil-lock-locked c-sidebar-nav-icon"></i> Ganti Password</a>
    </li>
</ul>
