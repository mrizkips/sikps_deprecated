<ul class="c-sidebar-nav">
    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('mahasiswa.beranda') }}">
        <i class="cil-speedometer c-sidebar-nav-icon"></i> Beranda</a>
    </li>
    <li class="c-sidebar-nav-title">KP & Skripsi</li>
    <li class="c-sidebar-nav-dropdown"><a class="c-sidebar-nav-dropdown-toggle" href="#">
        <i class="cil-task c-sidebar-nav-icon"></i> Proposal</a>
        <ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item"><a href="{{ route('mahasiswa.proposal.index') }}" class="c-sidebar-nav-link">
                Daftar Proposal</a>
            </li>
            <li class="c-sidebar-nav-item"><a href="{{ route('mahasiswa.proposal.create') }}" class="c-sidebar-nav-link">
                Tambah Proposal</a>
            </li>
        </ul>
    </li>
    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('mahasiswa.jadwal.index') }}">
        <i class="cil-calendar c-sidebar-nav-icon"></i> Jadwal Bimbingan</a>
    </li>
    <li class="c-sidebar-nav-dropdown"><a class="c-sidebar-nav-dropdown-toggle" href="#">
        <i class="cil-star c-sidebar-nav-icon"></i> Bimbingan</a>
        <ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item"><a href="{{ route('mahasiswa.bimbingan.index') }}" class="c-sidebar-nav-link">
                Daftar Bimbingan</a>
            </li>
            <li class="c-sidebar-nav-item"><a href="{{ route('mahasiswa.bimbingan.create') }}" class="c-sidebar-nav-link">
                Tambah Bimbingan</a>
            </li>
        </ul>
    </li>
    <li class="c-sidebar-nav-dropdown"><a class="c-sidebar-nav-dropdown-toggle" href="#">
        <i class="cil-briefcase c-sidebar-nav-icon"></i> Pengajuan Sidang</a>
        <ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item"><a href="{{ route('mahasiswa.sidang.index') }}" class="c-sidebar-nav-link">
                Daftar Pengajuan Sidang</a>
            </li>
            <li class="c-sidebar-nav-item"><a href="{{ route('mahasiswa.sidang.create') }}" class="c-sidebar-nav-link">
                Tambah Pengajuan Sidang</a>
            </li>
        </ul>
    </li>
    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('mahasiswa.pengujian.index') }}">
        <i class="cil-badge c-sidebar-nav-icon"></i> Pengujian Sidang</a>
    </li>
    <li class="c-sidebar-nav-title">Data Pengguna</li>
    <li class="c-sidebar-nav-dropdown"><a class="c-sidebar-nav-dropdown-toggle" href="#">
        <i class="cil-people c-sidebar-nav-icon"></i> Profil</a>
        <ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item"><a href="{{ route('mahasiswa.profil.show', Auth::user()->mahasiswa->id) }}" class="c-sidebar-nav-link">
                Lihat Profil</a>
            </li>
            <li class="c-sidebar-nav-item"><a href="{{ route('mahasiswa.profil.edit', Auth::user()->mahasiswa->id) }}" class="c-sidebar-nav-link">
                Edit Profil</a>
            </li>
        </ul>
    </li>
</ul>
