<div class="form-group row">
    <label for="nama" class="col-md-3 col-form-label">Nama Form*</label>
    <div class="col-md">
        @include('components.input', [
            'type' => 'text',
            'name' => 'nama',
            'value' => isset($form_penilaian) ? $form_penilaian->nama : old('nama'),
            'required' => false,
            'autofocus' => true,
            'placeholder' => trans('form_penilaian.placeholders.nama'),
        ])
    </div>
</div>
<div class="form-group row">
    <label for="jenis" class="col-md-3 col-form-label">Jenis Form*</label>
    <div class="col-md">
        @foreach ($jenis as $key => $item)
            <div class="form-check">
                <input type="radio" name="jenis" id="jenis{{ $key }}" class="form-check-input @error('jenis') is-invalid @enderror" value="{{ $key }}" {{ isset($form_penilaian) ? ($form_penilaian->jenis == $key ? 'checked' : '') : ((old('jenis') == $key ? 'checked' : '')) }}>
                <label for="jenis{{ $key }}" class="form-check-label">{{ $item }}</label>
                @if (end($jenis) == $item)
                    @error('jenis')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                @endif
            </div>
        @endforeach
    </div>
</div>
<div class="form-group row">
    <label for="penilai" class="col-md-3 col-form-label">Penilai*</label>
    <div class="col-md">
        @foreach ($penilai as $key => $item)
            <div class="form-check">
                <input type="radio" name="penilai" id="penilai{{ $key }}" class="form-check-input @error('penilai') is-invalid @enderror" value="{{ $key }}" {{ isset($form_penilaian) ? ($form_penilaian->penilai == $key ? 'checked' : '') : ((old('penilai') == $key ? 'checked' : '')) }}>
                <label for="penilai{{ $key }}" class="form-check-label">{{ $item }}</label>
                @if (end($penilai) == $item)
                @error('penilai')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                @endif
            </div>
        @endforeach
    </div>
</div>
