<ul class="c-sidebar-nav">
    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('dosen.beranda') }}">
        <i class="cil-speedometer c-sidebar-nav-icon"></i> Beranda</a>
    </li>
    <li class="c-sidebar-nav-dropdown"><a class="c-sidebar-nav-dropdown-toggle" href="#">
        <i class="cil-people c-sidebar-nav-icon"></i> Profil</a>
        <ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item"><a href="{{ route('dosen.dosen.show', Auth::user()->dosen->id) }}" class="c-sidebar-nav-link">
                Lihat Profil</a>
            </li>
            <li class="c-sidebar-nav-item"><a href="{{ route('dosen.dosen.edit', Auth::user()->dosen->id) }}" class="c-sidebar-nav-link">
                Edit Profil</a>
            </li>
        </ul>
    </li>
</ul>
