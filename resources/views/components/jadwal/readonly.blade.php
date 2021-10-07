<div class="form-group row">
    <label for="nama" class="col-md-3 col-form-label">Dosen</label>
    <div class="col-md">
        <input type="text" name="nama" id="nama" value="{{ $jadwal->dosen->user->nama }}" class="form-control-plaintext" disabled>
    </div>
</div>
<div class="form-group row">
    <label for="tanggal" class="col-md-3 col-form-label">Tanggal</label>
    <div class="col-md">
        <input type="text" name="tanggal" id="tanggal" value="{{ date_format_id($jadwal->tanggal) }}" class="form-control-plaintext" disabled>
    </div>
</div>
<div class="form-group row">
    <label for="mulai" class="col-md-3 col-form-label">Jam Mulai</label>
    <div class="col-md">
        <input type="text" name="mulai" id="mulai" value="{{ $jadwal->mulai }}" class="form-control-plaintext" disabled>
    </div>
</div>
<div class="form-group row">
    <label for="selesai" class="col-md-3 col-form-label">Jam Selesai</label>
    <div class="col-md">
        <input type="text" name="selesai" id="selesai" value="{{ $jadwal->selesai }}" class="form-control-plaintext" disabled>
    </div>
</div>
<div class="form-group row">
    <label for="pin" class="col-md-3 col-form-label">Pin</label>
    <div class="col-md">
        <input type="text" name="pin" id="pin" value="{{ $jadwal->pin }}" class="form-control-plaintext" disabled>
    </div>
</div>
<div class="form-group row">
    <label for="link" class="col-md-3 col-form-label">Link</label>
    <div class="col-md">
        @isset($jadwal->link)
        <a href="{{ $jadwal->link }}" class="form-control-plaintext">{{ $jadwal->link }}</a>
        @else
        <input type="text" name="link" id="link" value="-" class="form-control-plaintext" disabled>
        @endisset
    </div>
</div>
<div class="form-group row">
    <label for="catatan" class="col-md-3 col-form-label">Catatan</label>
    <div class="col-md">
        <textarea name="catatan" id="catatan" class="form-control-plaintext">{{ $jadwal->catatan?: '-' }}</textarea>
    </div>
</div>
