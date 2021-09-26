<div class="form-group row">
    <label for="nama" class="col-md-3 col-form-label">Nama</label>
    <div class="col-md">
        <input type="text" name="nama" id="nama" value="{{ $dosen->user->nama }}" class="form-control-plaintext" disabled>
    </div>
</div>
<div class="form-group row">
    <label for="jen_kel" class="col-md-3 col-form-label">Jenis Kelamin</label>
    <div class="col-md">
        <input type="text" name="jen_kel" id="jen_kel" value="{{ $dosen->jen_kel }}" class="form-control-plaintext" disabled>
    </div>
</div>
<div class="form-group row">
    <label for="email" class="col-md-3 col-form-label">Email</label>
    <div class="col-md">
        <input type="text" name="email" id="email" value="{{ $dosen->user->email }}" class="form-control-plaintext" disabled>
    </div>
</div>
<div class="form-group row">
    <label for="nidn" class="col-md-3 col-form-label">NIDN</label>
    <div class="col-md">
        <input type="text" name="nidn" id="nidn" value="{{ $dosen->nidn }}" class="form-control-plaintext" disabled>
    </div>
</div>
<div class="form-group row">
    <label for="no_hp" class="col-md-3 col-form-label">No. HP</label>
    <div class="col-md">
        <input type="text" name="no_hp" id="no_hp" value="{{ $dosen->no_hp }}" class="form-control-plaintext" disabled>
    </div>
</div>
<div class="form-group row">
    <label for="keahlian" class="col-md-3 col-form-label">Keahlian</label>
    <div class="col-md">
        <input type="text" name="keahlian" id="keahlian" value="{{ $dosen->keahlian }}" class="form-control-plaintext" disabled>
    </div>
</div>
