<div class="form-group row">
    <label for="nama" class="col-md-3 col-form-label">Nama*</label>
    <div class="col-md">
        @include('components.input', [
            'type' => 'text',
            'name' => 'nama',
            'value' => isset($dosen) ? $dosen->user->nama : old('nama'),
            'required' => false,
            'autofocus' => true,
            'placeholder' => trans('dosen.placeholders.nama'),
        ])
    </div>
</div>
<div class="form-group row">
    <label for="jen_kel" class="col-md-3 col-form-label">Jenis Kelamin*</label>
    <div class="col-md">
        <select name="jen_kel" id="jen_kel" class="form-control @error('jen_kel') is-invalid @enderror">
            <option>{{ trans('dosen.placeholders.jen_kel') }}</option>
            @foreach (config('constant.jen_kel') as $item)
                <option value="{{ $item }}" {{ isset($dosen) ? ($dosen->jen_kel == $item ? 'selected' : '') : '' }}>{{ $item }}</option>
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
    <label for="email" class="col-md-3 col-form-label">Email*</label>
    <div class="col-md">
        @include('components.input', [
            'type' => 'email',
            'name' => 'email',
            'value' => isset($dosen) ? $dosen->user->email : old('email'),
            'required' => false,
            'autofocus' => false,
            'placeholder' => trans('dosen.placeholders.email'),
        ])
    </div>
</div>
<div class="form-group row">
    <label for="nidn" class="col-md-3 col-form-label">NIDN*</label>
    <div class="col-md">
        @include('components.input', [
            'type' => 'text',
            'name' => 'nidn',
            'value' => isset($dosen) ? $dosen->nidn : old('nidn'),
            'required' => false,
            'autofocus' => false,
            'placeholder' => trans('dosen.placeholders.nidn'),
        ])
    </div>
</div>
<div class="form-group row">
    <label for="no_hp" class="col-md-3 col-form-label">No. HP*</label>
    <div class="col-md">
        @include('components.input', [
            'type' => 'number',
            'name' => 'no_hp',
            'value' => isset($dosen) ? $dosen->no_hp : old('no_hp'),
            'required' => false,
            'autofocus' => false,
            'placeholder' => trans('dosen.placeholders.no_hp'),
        ])
    </div>
</div>
<div class="form-group row">
    <label for="keahlian" class="col-md-3 col-form-label">Keahlian</label>
    <div class="col-md">
        @include('components.input', [
            'type' => 'text',
            'name' => 'keahlian',
            'value' => isset($dosen) ? $dosen->keahlian : old('keahlian'),
            'required' => false,
            'autofocus' => false,
            'placeholder' => trans('dosen.placeholders.keahlian'),
        ])
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
            'placeholder' => trans('dosen.placeholders.password'),
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
            'placeholder' => trans('dosen.placeholders.password'),
        ])
    </div>
</div>
