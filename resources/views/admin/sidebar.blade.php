<ul class="c-sidebar-nav">
    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('admin.beranda') }}">
        <i class="cil-speedometer c-sidebar-nav-icon"></i> Beranda</a>
    </li>
    <li class="c-sidebar-nav-title">KP & Skripsi</li>
    <li class="c-sidebar-nav-dropdown"><a class="c-sidebar-nav-dropdown-toggle" href="#">
        <i class="cil-calendar-check c-sidebar-nav-icon"></i> Pendaftaran</a>
        <ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item"><a href="{{ route('admin.pendaftaran.index') }}" class="c-sidebar-nav-link">
                Daftar Pendaftaran</a>
            </li>
            <li class="c-sidebar-nav-item"><a href="{{ route('admin.pendaftaran.create') }}" class="c-sidebar-nav-link">
                Tambah Pendaftaran</a>
            </li>
        </ul>
    </li>
    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('admin.proposal.index') }}">
        <i class="cil-task c-sidebar-nav-icon"></i> Proposal</a>
    </li>
    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('admin.jadwal.index') }}">
        <i class="cil-calendar c-sidebar-nav-icon"></i> Jadwal Bimbingan</a>
    </li>
    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('admin.bimbingan.index') }}">
        <i class="cil-star c-sidebar-nav-icon"></i> Bimbingan</a>
    </li>
    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('admin.sidang.index') }}">
        <i class="cil-briefcase c-sidebar-nav-icon"></i> Pengajuan Sidang</a>
    </li>
    <li class="c-sidebar-nav-dropdown"><a class="c-sidebar-nav-dropdown-toggle" href="#">
        <i class="cil-paperclip c-sidebar-nav-icon"></i> Jadwal Sidang</a>
        <ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item"><a href="{{ route('admin.jadwal_sidang.index') }}" class="c-sidebar-nav-link">
                Daftar Jadwal Sidang</a>
            </li>
            <li class="c-sidebar-nav-item"><a href="{{ route('admin.jadwal_sidang.create') }}" class="c-sidebar-nav-link">
                Tambah Jadwal Sidang</a>
            </li>
        </ul>
    </li>
    <li class="c-sidebar-nav-dropdown"><a class="c-sidebar-nav-dropdown-toggle" href="#">
        <i class="cil-badge c-sidebar-nav-icon"></i> Pengujian Sidang</a>
        <ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item"><a href="{{ route('admin.pengujian.index') }}" class="c-sidebar-nav-link">
                Daftar Pengujian Sidang</a>
            </li>
            <li class="c-sidebar-nav-item"><a href="{{ route('admin.pengujian.create') }}" class="c-sidebar-nav-link">
                Tambah Pengujian Sidang</a>
            </li>
        </ul>
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
