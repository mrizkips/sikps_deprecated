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
    <label for="sidang" class="col-md-3 col-form-label">Pengajuan Sidang</label>
    <div class="col-md">
        <input type="text" name="sidang" id="sidang" value="{{ $pengujian->sidang->proposal->judul }} - {{ $pengujian->sidang->proposal->mahasiswa->user->nama }}" class="form-control-plaintext" disabled>
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
        <a href="{{ route("admin.penguji.create", $pengujian->id) }}" class="btn btn-primary mb-2">
            <i class="cil-plus"></i> Tambah Penguji
        </a>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable">
                <thead>
                    <tr>
                        <td>#</td>
                        <td>Dosen Penguji</td>
                        <td>Role</td>
                        <td>Tanggal Dibuat</td>
                        <td>Aksi</td>
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
                            <td>
                                @include('components.edit', ['url' => route('admin.penguji.edit', ['pengujian' => $pengujian, 'penguji' => $item])])
                                @include('components.delete', ['url' => route('admin.penguji.destroy', ['pengujian' => $pengujian, 'penguji' => $item])])
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
