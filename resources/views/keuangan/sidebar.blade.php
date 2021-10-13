<ul class="c-sidebar-nav">
    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('keuangan.beranda') }}">
        <i class="cil-speedometer c-sidebar-nav-icon"></i> Beranda</a>
    </li>
    <li class="c-sidebar-nav-title">KP & Skripsi</li>
    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('keuangan.proposal.index') }}">
        <i class="cil-task c-sidebar-nav-icon"></i> Proposal</a>
    </li>
    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('keuangan.sidang.index') }}">
        <i class="cil-briefcase c-sidebar-nav-icon"></i> Pengajuan Sidang</a>
    </li>
    <li class="c-sidebar-nav-title">Data Pengguna</li>
    <li class="c-sidebar-nav-dropdown"><a class="c-sidebar-nav-dropdown-toggle" href="#">
        <i class="cil-people c-sidebar-nav-icon"></i> Profil</a>
        <ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item"><a href="{{ route('keuangan.profil.show', Auth::user()->keuangan->id) }}" class="c-sidebar-nav-link">
                Lihat Profil</a>
            </li>
            <li class="c-sidebar-nav-item"><a href="{{ route('keuangan.profil.edit', Auth::user()->keuangan->id) }}" class="c-sidebar-nav-link">
                Edit Profil</a>
            </li>
        </ul>
    </li>
</ul>
