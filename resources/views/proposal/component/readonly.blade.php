<div class="form-group row">
    <label for="judul" class="col-md-3 col-form-label">Judul</label>
    <div class="col-md">
        <input type="text" name="judul" id="judul" value="{{ $proposal->judul }}" class="form-control-plaintext">
    </div>
</div>
<div class="form-group row">
    <label for="jenis" class="col-md-3 col-form-label">Jenis</label>
    <div class="col-md">
        <input type="text" name="jenis" id="jenis" value="{{ $proposal->jenis }}" class="form-control-plaintext">
    </div>
</div>
<div class="form-group row">
    <label for="dokumen" class="col-md-3 col-form-label">Dokumen</label>
    <div class="col-md">
        <a href="{{ asset("storage/{$proposal->dokumen}") }}">{{ $proposal->dokumen }}</a>
    </div>
</div>
<div class="form-group row">
    <label for="pendaftaran_id" class="col-md-3 col-form-label">Periode Pendaftaran</label>
    <div class="col-md">
        <input type="text" name="pendaftaran_id" id="pendaftaran_id" value="{{ $proposal->pendaftaran->judul }}" class="form-control-plaintext">
    </div>
</div>
@foreach ($proposal->status->approval as $approval)
<div class="form-group row">
    <label for="approval_prodi" class="col-md-3 col-form-label">Persetujuan {{ $approval->role->nama }}</label>
    <div class="col-md">
        @include('proposal.component.status', ['status' => $approval->tipe])
    </div>
</div>
@isset($approval->catatan)
<div class="form-group row">
    <label for="catatan_{{ $approval->id }}" class="col-md-3 col-form-label">Catatan</label>
    <div class="col-md">
        <input type="text" name="catatan_{{ $approval->id }}" id="catatan_{{ $approval->id }}" value="{{ $approval->catatan }}" class="form-control-plaintext">
    </div>
</div>
@endisset
@endforeach
<div class="form-group row">
    <label for="dosen_id" class="col-md-3 col-form-label">Dosen Pembimbing</label>
    <div class="col-md">
        <input type="text" name="dosen_id" id="dosen_id" value="{{ isset($proposal->dosen_id) ? $proposal->dosen->user->nama : '-' }}" class="form-control-plaintext">
    </div>
</div>
<div class="form-group row">
    <label for="kbb_id" class="col-md-3 col-form-label">KBB</label>
    <div class="col-md">
        <input type="text" name="kbb_id" id="kbb_id" value="{{ $proposal->kbb->nama }}" class="form-control-plaintext">
    </div>
</div>
<div class="form-group row">
    <label for="tanggal_kontrak" class="col-md-3 col-form-label">Tanggal Kontrak</label>
    <div class="col-md">
        <input type="text" name="tanggal_kontrak" id="tanggal_kontrak" value="{{ date_format_id($proposal->tanggal_kontrak) }}" class="form-control-plaintext">
    </div>
</div>
