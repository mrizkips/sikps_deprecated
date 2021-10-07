<ul class="c-sidebar-nav">
    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('dosen.beranda') }}">
        <i class="cil-speedometer c-sidebar-nav-icon"></i> Beranda</a>
    </li>
    <li class="c-sidebar-nav-title">KP & Skripsi</li>
    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('dosen.proposal.index') }}">
        <i class="cil-task c-sidebar-nav-icon"></i> Proposal</a>
    </li>
    <li class="c-sidebar-nav-dropdown"><a class="c-sidebar-nav-dropdown-toggle" href="#">
        <i class="cil-calendar c-sidebar-nav-icon"></i> Jadwal Bimbingan</a>
        <ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item"><a href="{{ route('dosen.jadwal.index') }}" class="c-sidebar-nav-link">
                Daftar Jadwal</a>
            </li>
            <li class="c-sidebar-nav-item"><a href="{{ route('dosen.jadwal.create') }}" class="c-sidebar-nav-link">
                Tambah Jadwal</a>
            </li>
        </ul>
    </li>
    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('dosen.bimbingan.index') }}">
        <i class="cil-star c-sidebar-nav-icon"></i> Bimbingan</a>
    </li>
    <li class="c-sidebar-nav-title">Data Pengguna</li>
    <li class="c-sidebar-nav-dropdown"><a class="c-sidebar-nav-dropdown-toggle" href="#">
        <i class="cil-people c-sidebar-nav-icon"></i> Profil</a>
        <ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item"><a href="{{ route('dosen.profil.show', Auth::user()->dosen->id) }}" class="c-sidebar-nav-link">
                Lihat Profil</a>
            </li>
            <li class="c-sidebar-nav-item"><a href="{{ route('dosen.profil.edit', Auth::user()->dosen->id) }}" class="c-sidebar-nav-link">
                Edit Profil</a>
            </li>
        </ul>
    </li>
</ul>
