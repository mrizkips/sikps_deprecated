<div class="form-group row">
    <label for="proposal_id" class="col-md-3 col-form-label">Proposal</label>
    <div class="col-md">
        <input type="text" name="proposal_id" id="proposal_id" value="{{ $bimbingan->proposal->judul }}" class="form-control-plaintext" disabled>
    </div>
</div>
<div class="form-group row">
    <label for="dosen" class="col-md-3 col-form-label">Dosen Pembimbing</label>
    <div class="col-md">
        <input type="text" name="dosen" id="dosen" value="{{ $bimbingan->dosen->user->nama }}" class="form-control-plaintext" disabled>
    </div>
</div>
<div class="form-group row">
    <label for="dosen" class="col-md-3 col-form-label">Mahasiswa</label>
    <div class="col-md">
        <input type="text" name="dosen" id="dosen" value="{{ $bimbingan->mahasiswa->user->nama }}" class="form-control-plaintext" disabled>
    </div>
</div>
<div class="form-group row">
    <label for="jadwal_id" class="col-md-3 col-form-label">Jadwal</label>
    <div class="col-md">
        <input type="text" name="jadwal_id" id="jadwal_id" value="{{ date_format_id($bimbingan->jadwal->tanggal) }}, {{ date('H:i', strtotime($bimbingan->jadwal->mulai)) }} - {{ date('H:i', strtotime($bimbingan->jadwal->selesai)) }}" class="form-control-plaintext" disabled>
    </div>
</div>
<div class="form-group row">
    <label for="catatan" class="col-md-3 col-form-label">Catatan</label>
    <div class="col-md">
        <textarea name="catatan" id="catatan" class="form-control-plaintext">{{ $bimbingan->catatan }}</textarea>
    </div>
</div>
