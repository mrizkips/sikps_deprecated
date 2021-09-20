<div class="form-group row">
    <label for="judul" class="col-md-3 col-form-label">Judul*</label>
    <div class="col-md">
        @include('components.input', [
            'type' => 'text',
            'name' => 'judul',
            'value' => isset($pendaftaran) ? $pendaftaran->judul : old('judul'),
            'required' => false,
            'autofocus' => true,
            'placeholder' => trans('pendaftaran.placeholders.judul'),
        ])
    </div>
</div>
<div class="form-group row">
    <label for="jenis" class="col-md-3 col-form-label">Jenis*</label>
    <div class="col-md">
        <select name="jenis" id="jenis" class="form-control @error('jenis') is-invalid @enderror">
            <option>{{ trans('pendaftaran.placeholders.jenis') }}</option>
            @foreach (config('constant.jenis_pendaftaran') as $item)
                <option value="{{ $item }}" {{ isset($pendaftaran) ? ($pendaftaran->jenis == $item ? 'selected' : '') : '' }}>{{ $item }}</option>
            @endforeach
        </select>
        @error('jenis')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="awal" class="col-md-3 col-form-label">Tanggal Pembuka*</label>
    <div class="col-md">
        @include('components.input', [
            'type' => 'date',
            'name' => 'awal',
            'value' => isset($pendaftaran) ? $pendaftaran->awal : old('awal'),
            'required' => false,
            'autofocus' => false,
            'placeholder' => trans('pendaftaran.placeholders.awal'),
        ])
    </div>
</div>
<div class="form-group row">
    <label for="akhir" class="col-md-3 col-form-label">Tanggal Penutup*</label>
    <div class="col-md">
        @include('components.input', [
            'type' => 'date',
            'name' => 'akhir',
            'value' => isset($pendaftaran) ? $pendaftaran->akhir : old('akhir'),
            'required' => false,
            'autofocus' => false,
            'placeholder' => trans('pendaftaran.placeholders.akhir'),
        ])
    </div>
</div>
