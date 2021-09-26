<div class="form-group row">
    <label for="nama" class="col-md-3 col-form-label">Nama</label>
    <div class="col-md">
        <input type="text" name="nama" id="nama" value="{{ $mahasiswa->user->nama }}" class="form-control-plaintext" disabled>
    </div>
</div>
<div class="form-group row">
    <label for="jen_kel" class="col-md-3 col-form-label">Jenis Kelamin</label>
    <div class="col-md">
        <input type="text" name="jen_kel" id="jen_kel" value="{{ $mahasiswa->jen_kel }}" class="form-control-plaintext" disabled>
    </div>
</div>
<div class="form-group row">
    <label for="jen_kel" class="col-md-3 col-form-label">Tempat Lahir</label>
    <div class="col-md">
        <input type="text" name="tempat_lahir" id="tempat_lahir" value="{{ $mahasiswa->tempat_lahir }}" class="form-control-plaintext" disabled>
    </div>
</div>
<div class="form-group row">
    <label for="jen_kel" class="col-md-3 col-form-label">Tanggal Lahir</label>
    <div class="col-md">
        <input type="text" name="tanggal_lahir" id="tanggal_lahir" value="{{ date_format_id($mahasiswa->tanggal_lahir) }}" class="form-control-plaintext" disabled>
    </div>
</div>
<div class="form-group row">
    <label for="email" class="col-md-3 col-form-label">Email</label>
    <div class="col-md">
        <input type="text" name="email" id="email" value="{{ $mahasiswa->user->email }}" class="form-control-plaintext" disabled>
    </div>
</div>
<div class="form-group row">
    <label for="nim" class="col-md-3 col-form-label">NIM</label>
    <div class="col-md">
        <input type="text" name="nim" id="nim" value="{{ $mahasiswa->nim }}" class="form-control-plaintext" disabled>
    </div>
</div>
<div class="form-group row">
    <label for="nim" class="col-md-3 col-form-label">Jurusan</label>
    <div class="col-md">
        <input type="text" name="jurusan_id" id="jurusan_id" value="{{ $mahasiswa->jurusan->nama }}" class="form-control-plaintext" disabled>
    </div>
</div>
<div class="form-group row">
    <label for="nim" class="col-md-3 col-form-label">KBB</label>
    <div class="col-md">
        <input type="text" name="kbb_id" id="kbb_id" value="{{ $mahasiswa->kbb->nama }}" class="form-control-plaintext" disabled>
    </div>
</div>
<div class="form-group row">
    <label for="no_hp" class="col-md-3 col-form-label">No. HP</label>
    <div class="col-md">
        <input type="text" name="no_hp" id="no_hp" value="{{ $mahasiswa->no_hp }}" class="form-control-plaintext" disabled>
    </div>
</div>
<div class="form-group row">
    <label for="no_hp" class="col-md-3 col-form-label">Alamat</label>
    <div class="col-md">
        <textarea name="alamat" id="alamat" class="form-control-plaintext" disabled>{{ $mahasiswa->alamat }}</textarea>
    </div>
</div>
