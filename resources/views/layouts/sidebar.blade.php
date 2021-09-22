@auth('admin')
    @include('admin.sidebar')

@elseif(Auth::guard('mahasiswa')->check())
    @include('mahasiswa.sidebar')

@elseif(Auth::guard('dosen')->check())
    @include('dosen.sidebar')

@elseif(Auth::guard('baak')->check())
    @include('baak.sidebar')

@elseif(Auth::guard('keuangan')->check())
    @include('keuangan.sidebar')

@endauth
