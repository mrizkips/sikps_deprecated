<div class="form-group row">
    <label for="nama" class="col-md-3 col-form-label">Nama*</label>
    <div class="col-md">
        @include('components.input', [
            'type' => 'text',
            'name' => 'nama',
            'value' => isset($mahasiswa) ? $mahasiswa->user->nama : old('nama'),
            'required' => false,
            'autofocus' => true,
            'placeholder' => trans('mahasiswa.placeholders.nama'),
        ])
    </div>
</div>
<div class="form-group row">
    <label for="jen_kel" class="col-md-3 col-form-label">Jenis Kelamin*</label>
    <div class="col-md">
        <select name="jen_kel" id="jen_kel" class="form-control @error('jen_kel') is-invalid @enderror">
            <option>{{ trans('mahasiswa.placeholders.jen_kel') }}</option>
            @foreach (config('constant.jen_kel') as $item)
                <option value="{{ $item }}" {{ isset($mahasiswa) ? ($mahasiswa->jen_kel == $item ? 'selected' : '') : '' }}>{{ $item }}</option>
            @endforeach
        </select>
        @error('jen_kel')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="tempat_lahir" class="col-md-3 col-form-label">Tempat Lahir*</label>
    <div class="col-md">
        @include('components.input', [
            'type' => 'text',
            'name' => 'tempat_lahir',
            'value' => isset($mahasiswa) ? $mahasiswa->tempat_lahir : old('tempat_lahir'),
            'required' => false,
            'autofocus' => false,
            'readonly' => false,
            'placeholder' => trans('mahasiswa.placeholders.tempat_lahir'),
        ])
    </div>
</div>
<div class="form-group row">
    <label for="tanggal_lahir" class="col-md-3 col-form-label">Tanggal Lahir*</label>
    <div class="col-md">
        @include('components.input', [
            'type' => 'date',
            'name' => 'tanggal_lahir',
            'value' => isset($mahasiswa) ? $mahasiswa->tanggal_lahir : old('tanggal_lahir'),
            'required' => false,
            'autofocus' => false,
            'readonly' => false,
            'placeholder' => trans('mahasiswa.placeholders.tanggal_lahir'),
        ])
    </div>
</div>
<div class="form-group row">
    <label for="email" class="col-md-3 col-form-label">Email*</label>
    <div class="col-md">
        @include('components.input', [
            'type' => 'email',
            'name' => 'email',
            'value' => isset($mahasiswa) ? $mahasiswa->user->email : old('email'),
            'required' => false,
            'autofocus' => false,
            'readonly' => isset($mahasiswa) ? true : false,
            'placeholder' => trans('mahasiswa.placeholders.email'),
        ])
    </div>
</div>
<div class="form-group row">
    <label for="nim" class="col-md-3 col-form-label">NIM*</label>
    <div class="col-md">
        @include('components.input', [
            'type' => 'text',
            'name' => 'nim',
            'value' => isset($mahasiswa) ? $mahasiswa->nim : old('nim'),
            'required' => false,
            'autofocus' => false,
            'readonly' => false,
            'placeholder' => trans('mahasiswa.placeholders.nim'),
        ])
    </div>
</div>
<div class="form-group row">
    <label for="jurusan_id" class="col-md-3 col-form-label">Jurusan*</label>
    <div class="col-md">
        <select name="jurusan_id" id="jurusan_id" class="form-control @error('jurusan_id') is-invalid @enderror">
            <option>{{ trans('mahasiswa.placeholders.jurusan_id') }}</option>
            @foreach ($jurusan as $item)
                <option value="{{ $item->id }}" {{ isset($mahasiswa) ? ($mahasiswa->jurusan_id == $item->id ? 'selected' : '') : '' }}>{{ $item->nama }}</option>
            @endforeach
        </select>
        @error('jurusan_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="kbb_id" class="col-md-3 col-form-label">KBB*</label>
    <div class="col-md">
        <select name="kbb_id" id="kbb_id" class="form-control @error('kbb_id') is-invalid @enderror">
            <option>{{ trans('mahasiswa.placeholders.kbb_id') }}</option>
            @foreach ($kbb as $item)
                <option value="{{ $item->id }}" {{ isset($mahasiswa) ? ($mahasiswa->kbb_id == $item->id ? 'selected' : '') : '' }}>{{ $item->nama }}</option>
            @endforeach
        </select>
        @error('kbb_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="no_hp" class="col-md-3 col-form-label">No. HP*</label>
    <div class="col-md">
        @include('components.input', [
            'type' => 'number',
            'name' => 'no_hp',
            'value' => isset($mahasiswa) ? $mahasiswa->no_hp : old('no_hp'),
            'required' => false,
            'autofocus' => false,
            'placeholder' => trans('mahasiswa.placeholders.no_hp'),
        ])
    </div>
</div>
<div class="form-group row">
    <label for="alamat" class="col-md-3 col-form-label">Alamat*</label>
    <div class="col-md">
        <textarea name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" placeholder="{{ trans('mahasiswa.placeholders.alamat') }}">{!! $mahasiswa->alamat !!}</textarea>
        @error('alamat')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="password" class="col-md-3 col-form-label">Password*</label>
    <div class="col-md">
        @include('components.input', [
            'type' => 'password',
            'name' => 'password',
            'value' => old('password'),
            'required' => false,
            'autofocus' => false,
            'placeholder' => trans('mahasiswa.placeholders.password'),
        ])
        <small class="form-text text-muted">Password tidak wajib diisi saat edit data</small>
    </div>
</div>
<div class="form-group row">
    <label for="password_confirmation" class="col-md-3 col-form-label">Konfirmasi Password*</label>
    <div class="col-md">
        @include('components.input', [
            'type' => 'password',
            'name' => 'password_confirmation',
            'value' => old('password_confirmation'),
            'required' => false,
            'autofocus' => false,
            'placeholder' => trans('mahasiswa.placeholders.password'),
        ])
    </div>
</div>
