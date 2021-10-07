<div class="form-group row">
    <label for="tanggal" class="col-md-3 col-form-label">Tanggal*</label>
    <div class="col-md">
        @include('components.input', [
            'type' => 'date',
            'name' => 'tanggal',
            'value' => isset($jadwal) ? $jadwal->tanggal : old('tanggal'),
            'required' => false,
            'autofocus' => true,
            'placeholder' => trans('jadwal.placeholders.tanggal'),
        ])
    </div>
</div>
<div class="form-group row">
    <label for="mulai" class="col-md-3 col-form-label">Jam Mulai*</label>
    <div class="col-md">
        @include('components.input', [
            'type' => 'time',
            'name' => 'mulai',
            'value' => isset($jadwal) ? date('H:i', strtotime($jadwal->mulai)) : old('mulai'),
            'required' => false,
            'autofocus' => false,
            'placeholder' => trans('jadwal.placeholders.mulai'),
        ])
    </div>
</div>
<div class="form-group row">
    <label for="selesai" class="col-md-3 col-form-label">Jam Selesai*</label>
    <div class="col-md">
        @include('components.input', [
            'type' => 'time',
            'name' => 'selesai',
            'value' => isset($jadwal) ? date('H:i', strtotime($jadwal->selesai)) : old('selesai'),
            'required' => false,
            'autofocus' => false,
            'placeholder' => trans('jadwal.placeholders.selesai'),
        ])
    </div>
</div>
<div class="form-group row">
    <label for="link" class="col-md-3 col-form-label">Link</label>
    <div class="col-md">
        @include('components.input', [
            'type' => 'text',
            'name' => 'link',
            'value' => isset($jadwal) ? $jadwal->link : old('link'),
            'required' => false,
            'autofocus' => false,
            'placeholder' => trans('jadwal.placeholders.link'),
        ])
    </div>
</div>
<div class="form-group row">
    <label for="catatan" class="col-md-3 col-form-label">Catatan</label>
    <div class="col-md">
        <textarea name="catatan" id="catatan" class="form-control @error('catatan') is-invalid @enderror" placeholder="{{ trans('jadwal.placeholders.catatan') }}">{{ isset($jadwal) ? $jadwal->catatan : old('catatan') }}</textarea>
        @error('catatan')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
