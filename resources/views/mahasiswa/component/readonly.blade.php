<div class="form-group row">
    <label for="nama" class="col-md-3 col-form-label">Nama</label>
    <div class="col-md">
        <input type="text" name="nama" id="nama" value="{{ $mahasiswa->user->nama }}" class="form-control-plaintext">
    </div>
</div>
<div class="form-group row">
    <label for="jen_kel" class="col-md-3 col-form-label">Jenis Kelamin</label>
    <div class="col-md">
        <input type="text" name="jen_kel" id="jen_kel" value="{{ $mahasiswa->jen_kel }}" class="form-control-plaintext">
    </div>
</div>
<div class="form-group row">
    <label for="email" class="col-md-3 col-form-label">Email</label>
    <div class="col-md">
        <input type="text" name="email" id="email" value="{{ $mahasiswa->user->email }}" class="form-control-plaintext">
    </div>
</div>
<div class="form-group row">
    <label for="nim" class="col-md-3 col-form-label">NIM</label>
    <div class="col-md">
        <input type="text" name="nim" id="nim" value="{{ $mahasiswa->nim }}" class="form-control-plaintext">
    </div>
</div>
<div class="form-group row">
    <label for="no_hp" class="col-md-3 col-form-label">No. HP</label>
    <div class="col-md">
        <input type="text" name="no_hp" id="no_hp" value="{{ $mahasiswa->no_hp }}" class="form-control-plaintext">
    </div>
</div>
