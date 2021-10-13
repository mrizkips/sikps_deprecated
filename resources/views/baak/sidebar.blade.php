<ul class="c-sidebar-nav">
    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('baak.beranda') }}">
        <i class="cil-speedometer c-sidebar-nav-icon"></i> Beranda</a>
    </li>
    <li class="c-sidebar-nav-title">KP & Skripsi</li>
    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('baak.proposal.index') }}">
        <i class="cil-task c-sidebar-nav-icon"></i> Proposal</a>
    </li>
    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('baak.sidang.index') }}">
        <i class="cil-briefcase c-sidebar-nav-icon"></i> Pengajuan Sidang</a>
    </li>
    <li class="c-sidebar-nav-title">Data Pengguna</li>
    <li class="c-sidebar-nav-dropdown"><a class="c-sidebar-nav-dropdown-toggle" href="#">
        <i class="cil-people c-sidebar-nav-icon"></i> Profil</a>
        <ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item"><a href="{{ route('baak.profil.show', Auth::user()->baak->id) }}" class="c-sidebar-nav-link">
                Lihat Profil</a>
            </li>
            <li class="c-sidebar-nav-item"><a href="{{ route('baak.profil.edit', Auth::user()->baak->id) }}" class="c-sidebar-nav-link">
                Edit Profil</a>
            </li>
        </ul>
    </li>
</ul>
