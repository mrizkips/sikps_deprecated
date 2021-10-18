<div class="form-group row">
    <label for="nama" class="col-md-3 col-form-label">Nama Item*</label>
    <div class="col-md">
        @include('components.input', [
            'type' => 'text',
            'name' => 'nama',
            'value' => isset($form_penilaian_item) ? $form_penilaian_item->nama : old('nama'),
            'required' => false,
            'autofocus' => true,
            'placeholder' => trans('form_penilaian_item.placeholders.nama'),
        ])
    </div>
</div>
<div class="form-group row">
    <label for="min" class="col-md-3 col-form-label">Nilai Minimum</label>
    <div class="col-md">
        @include('components.input', [
            'type' => 'number',
            'name' => 'min',
            'value' => isset($form_penilaian_item) ? $form_penilaian_item->min : old('min'),
            'required' => false,
            'autofocus' => false,
            'placeholder' => trans('form_penilaian_item.placeholders.min'),
        ])
        <small class="form-text text-muted">
            Nilai harus tidak kurang dari 0 dan tidak lebih dari 100.
        </small>
    </div>
</div>
<div class="form-group row">
    <label for="max" class="col-md-3 col-form-label">Nilai Maksimum</label>
    <div class="col-md">
        @include('components.input', [
            'type' => 'number',
            'name' => 'max',
            'value' => isset($form_penilaian_item) ? $form_penilaian_item->max : old('max'),
            'required' => false,
            'autofocus' => false,
            'placeholder' => trans('form_penilaian_item.placeholders.max'),
        ])
        <small class="form-text text-muted">
            Nilai harus tidak kurang dari 0 dan tidak lebih dari 100.
        </small>
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3 col-form-label">Opsi</label>
    <div class="col-md">
        <div class="form-check">
            <input type="checkbox" name="isian_text" id="isian_text" class="form-check-input @error('isian_text') is-invalid @enderror" value="true" {{ isset($form_penilaian_item) ? ($form_penilaian_item->min == null ? 'checked' : '') : (old('isian_text') ? 'checked' : '') }}>
            <label for="isian_text" class="form-check-label">Isian Text</label>
            @error('isian_text')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <small class="form-text text-muted">
            Centang jika isian adalah text, dan kosongkan nilai maksimum dan nilai minimum.
        </small>
    </div>
</div>
