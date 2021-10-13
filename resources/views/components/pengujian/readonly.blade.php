<div class="form-group row">
    <label for="judul" class="col-md-3 col-form-label">Periode Pendaftaran</label>
    <div class="col-md">
        <input type="text" name="judul" id="judul" value="{{ $pengujian->sidang->pendaftaran->judul }}" class="form-control-plaintext" disabled>
    </div>
</div>
<div class="form-group row">
    <label for="tanggal" class="col-md-3 col-form-label">Jadwal Sidang</label>
    <div class="col-md">
        <input type="text" name="tanggal" id="tanggal" value="{{ date_format_id($pengujian->jadwal_sidang->tanggal) }}, {{ date('H:i', strtotime($pengujian->jadwal_sidang->mulai)) }} - {{ date('H:i', strtotime($pengujian->jadwal_sidang->selesai)) }}" class="form-control-plaintext" disabled>
    </div>
</div>
<div class="form-group row">
    <label for="sidang" class="col-md-3 col-form-label">Pengajuan Sidang</label>
    <div class="col-md">
        <input type="text" name="sidang" id="sidang" value="{{ $pengujian->sidang->proposal->judul }} - {{ $pengujian->sidang->proposal->mahasiswa->user->nama }}" class="form-control-plaintext" disabled>
    </div>
</div>
<div class="form-group row">
    <label for="pembimbing" class="col-md-3 col-form-label">Dosen Pembimbing</label>
    <div class="col-md">
        <input type="text" name="pembimbing" id="pembimbing" value="{{ $pengujian->sidang->proposal->dosen->user->nama }}" class="form-control-plaintext" disabled>
    </div>
</div>
<div class="form-group row">
    <label for="penguji" class="col-md-3 col-form-label">Dosen Penguji</label>
    <div class="col-md">
        <input type="text" name="penguji" id="penguji" value="{{ $pengujian->dosen->user->nama }}" class="form-control-plaintext" disabled>
    </div>
</div>
<div class="form-group row">
    <label for="nilai_ppt" class="col-md-3 col-form-label">Nilai Presentasi</label>
    <div class="col-md">
        <input type="text" name="nilai_ppt" id="nilai_ppt" value="{{ $pengujian->nilai_ppt ?: '-' }}" class="form-control-plaintext" disabled>
    </div>
</div>
<div class="form-group row">
    <label for="nilai_laporan" class="col-md-3 col-form-label">Nilai Laporan</label>
    <div class="col-md">
        <input type="text" name="nilai_laporan" id="nilai_laporan" value="{{ $pengujian->nilai_laporan ?: '-' }}" class="form-control-plaintext" disabled>
    </div>
</div>
<div class="form-group row">
    <label for="nilai_aplikasi" class="col-md-3 col-form-label">Nilai Aplikasi</label>
    <div class="col-md">
        <input type="text" name="nilai_aplikasi" id="nilai_aplikasi" value="{{ $pengujian->nilai_aplikasi ?: '-' }}" class="form-control-plaintext" disabled>
    </div>
</div>
