<div class="form-group row">
    <label for="judul" class="col-md-3 col-form-label">Judul</label>
    <div class="col-md">
        <input type="text" name="judul" id="judul" value="{{ $sidang->proposal->judul }}" class="form-control-plaintext" disabled>
    </div>
</div>
<div class="form-group row">
    <label for="mahasiswa_id" class="col-md-3 col-form-label">Mahasiswa</label>
    <div class="col-md">
        <input type="text" name="mahasiswa_id" id="mahasiswa_id" value="{{ isset($sidang->proposal->mahasiswa_id) ? $sidang->proposal->mahasiswa->user->nama : '-' }}" class="form-control-plaintext" disabled>
    </div>
</div>
<div class="form-group row">
    <label for="dosen_id" class="col-md-3 col-form-label">Dosen Pembimbing</label>
    <div class="col-md">
        <input type="text" name="dosen_id" id="dosen_id" value="{{ isset($sidang->proposal->dosen_id) ? $sidang->proposal->dosen->user->nama : '-' }}" class="form-control-plaintext" disabled>
    </div>
</div>
<div class="form-group row">
    <label for="jenis" class="col-md-3 col-form-label">Jenis</label>
    <div class="col-md">
        <input type="text" name="jenis" id="jenis" value="{{ config('constant.jenis_sidang')[$sidang->jenis] }}" class="form-control-plaintext" disabled>
    </div>
</div>
<div class="form-group row">
    <label for="laporan" class="col-md-3 col-form-label">File Laporan</label>
    <div class="col-md">
        <a href="{{ asset("storage/{$sidang->laporan}") }}" class="btn btn-primary"><i class="cil-data-transfer-down"></i> Unduh Laporan</a>
    </div>
</div>
@isset($sidang->penilaian_kp)
<div class="form-group row">
    <label for="penilaian_kp" class="col-md-3 col-form-label">Form Penilaian KP</label>
    <div class="col-md">
        <a href="{{ asset("storage/{$sidang->penilaian_kp}") }}" class="btn btn-primary"><i class="cil-data-transfer-down"></i> Unduh Form</a>
    </div>
</div>
@endisset
<div class="form-group row">
    <label for="pendaftaran_id" class="col-md-3 col-form-label">Periode Pendaftaran</label>
    <div class="col-md">
        <input type="text" name="pendaftaran_id" id="pendaftaran_id" value="{{ $sidang->pendaftaran->judul }}" class="form-control-plaintext" disabled>
    </div>
</div>
@foreach ($sidang->status->approval as $approval)
<div class="form-group row">
    <label for="approval" class="col-md-3 col-form-label text-capitalize">Persetujuan {{ $approval->role->nama }}</label>
    <div class="col-md">
        @include('components.status', ['status' => $approval->tipe])
    </div>
</div>
@isset($approval->catatan)
<div class="form-group row">
    <label for="catatan_{{ $approval->id }}" class="col-md-3 col-form-label">Catatan</label>
    <div class="col-md">
        <input type="text" name="catatan_{{ $approval->id }}" id="catatan_{{ $approval->id }}" value="{{ $approval->catatan }}" class="form-control-plaintext" disabled>
    </div>
</div>
@endisset
@endforeach
<div class="form-group row">
    <label for="tanggal_kontrak" class="col-md-3 col-form-label">Tanggal Kontrak</label>
    <div class="col-md">
        <input type="text" name="tanggal_kontrak" id="tanggal_kontrak" value="{{ date_format_id($sidang->pendaftaran->tanggal_kontrak) }}" class="form-control-plaintext" disabled>
    </div>
</div>
