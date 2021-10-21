<div class="form-group row">
    <label for="judul" class="col-md-3 col-form-label">Periode Pendaftaran</label>
    <div class="col-md">
        <input type="text" name="judul" id="judul" value="{{ $pengujian->sidang->pendaftaran->judul }}" class="form-control-plaintext" disabled>
    </div>
</div>
<div class="form-group row">
    <label for="jenis" class="col-md-3 col-form-label">Jenis Sidang</label>
    <div class="col-md">
        <input type="text" name="jenis" id="jenis" value="{{ config('constant.jenis_sidang')[$pengujian->sidang->jenis] }}" class="form-control-plaintext" disabled>
    </div>
</div>
<div class="form-group row">
    <label for="nama" class="col-md-3 col-form-label">Nama Mahasiswa</label>
    <div class="col-md">
        <input type="text" name="nama" id="nama" value="{{ $pengujian->sidang->proposal->mahasiswa->user->nama }}" class="form-control-plaintext" disabled>
    </div>
</div>
<div class="form-group row">
    <label for="judul" class="col-md-3 col-form-label">Judul Proposal</label>
    <div class="col-md">
        <input type="text" name="judul" id="judul" value="{{ $pengujian->sidang->proposal->judul }}" class="form-control-plaintext" disabled>
    </div>
</div>
<div class="form-group row">
    <label for="tanggal" class="col-md-3 col-form-label">Tanggal</label>
    <div class="col-md">
        <input type="text" name="tanggal" id="tanggal" value="{{ date_format_id($pengujian->tanggal) }}" class="form-control-plaintext" disabled>
    </div>
</div>
<div class="form-group row">
    <label for="jam" class="col-md-3 col-form-label">Jam</label>
    <div class="col-md">
        <input type="text" name="jam" id="jam" value="{{ date('H:i', strtotime($pengujian->mulai)) }} - {{ date('H:i', strtotime($pengujian->selesai)) }}" class="form-control-plaintext" disabled>
    </div>
</div>
<div class="form-group row">
    <label for="ruangan" class="col-md-3 col-form-label">Ruangan</label>
    <div class="col-md">
        <input type="text" name="ruangan" id="ruangan" value="{{ $pengujian->ruangan }}" class="form-control-plaintext" disabled>
    </div>
</div>
@isset($pengujian->catatan)
<div class="form-group row">
    <label for="catatan" class="col-md-3 col-form-label">Catatan</label>
    <div class="col-md">
        <input type="text" name="catatan" id="catatan" value="{{ $pengujian->catatan }}" class="form-control-plaintext" disabled>
    </div>
</div>
@endisset
<div class="form-group row">
    <label for="penguji" class="col-md-3 col-form-label">Penguji</label>
    <div class="col-md">
        @auth('admin')
            <a href="{{ route("admin.penguji.create", $pengujian->id) }}" class="btn btn-primary mb-2">
                <i class="cil-plus"></i> Tambah Penguji
            </a>
        @endauth
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable">
                <thead>
                    <tr>
                        <td>#</td>
                        <td>Dosen Penguji</td>
                        <td>Role</td>
                        <td>Tanggal Dibuat</td>
                        @auth('admin')
                        <td>Aksi</td>
                        @endauth
                    </tr>
                </thead>
                <tbody>
                    @if($pengujian->penguji->isEmpty())
                        <tr>
                            <td colspan="5">Data tidak ditemukan.</td>
                        </tr>
                    @endif

                    @foreach ($pengujian->penguji as $key => $item)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $item->dosen->user->nama }}</td>
                            <td>Penguji {{ $item->role }}</td>
                            <td>{{ $item->created_at }}</td>
                            @auth('admin')
                            <td>
                                @include('components.edit', ['url' => route('admin.penguji.edit', ['pengujian' => $pengujian, 'penguji' => $item])])
                                @include('components.delete', ['url' => route('admin.penguji.destroy', ['pengujian' => $pengujian, 'penguji' => $item])])
                            </td>
                            @endauth
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="form-group row">
    <label for="penilaian" class="col-md-3 col-form-label">Penilaian</label>
    <div class="col-md">
        @isset($form_penilaian)
        <a href="{{ route(auth()->user()->role->nama.".penilaian.create", $pengujian->id) }}" class="btn btn-primary mb-2">
            <i class="cil-plus"></i> Tambah Penilaian
        </a>
        @endisset
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable">
                <thead>
                    <tr>
                        <td>#</td>
                        <td>Penilai</td>
                        <td>Form</td>
                        <td>Role</td>
                        <td>Tanggal Dibuat</td>
                        <td>Aksi</td>
                    </tr>
                </thead>
                <tbody>
                    @if($pengujian->penilaian->isEmpty())
                        <tr>
                            <td colspan="5">Data tidak ditemukan.</td>
                        </tr>
                    @endif

                    @foreach ($pengujian->penilaian as $key => $item)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $item->user->nama }}</td>
                            <td>{{ $item->form_penilaian->nama }}</td>
                            <td>{{ config('constant.penilai')[$item->form_penilaian->penilai] }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>
                                @include('components.show', ['url' => route(auth()->user()->role->nama.'.penilaian.show', ['pengujian' => $pengujian, 'penilaian' => $item])])
                                @if ($item->user_id == auth()->user()->id)
                                @include('components.edit', ['url' => route(auth()->user()->role->nama.'.penilaian.edit', ['pengujian' => $pengujian, 'penilaian' => $item])])
                                @include('components.delete', ['url' => route(auth()->user()->role->nama.'.penilaian.destroy', ['pengujian' => $pengujian, 'penilaian' => $item])])
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
