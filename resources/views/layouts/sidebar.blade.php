@auth('admin')
@include('admin.sidebar')
@elseif(Auth::guard('mahasiswa')->check())
@include('mahasiswa.sidebar')
@elseif(Auth::guard('dosen')->check())
@include('dosen.sidebar')
@endauth
