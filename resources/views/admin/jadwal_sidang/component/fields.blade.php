<div class="form-group row">
    <label for="pendaftaran_id" class="col-md-3 col-form-label">Periode Pendaftaran*</label>
    <div class="col-md">
        <select name="pendaftaran_id" id="pendaftaran_id" class="form-control @error('pendaftaran_id') is-invalid @enderror" @isset($jadwal_sidang)disabled @endisset>
            <option>{{ trans('jadwal_sidang.placeholders.pendaftaran_id') }}</option>
            @foreach ($pendaftaran as $item)
                <option value="{{ $item->id }}" {{ isset($jadwal_sidang) ? ($jadwal_sidang->pendaftaran_id == $item->id ? 'selected' : (old('pendaftaran_id') == $item->id ? 'selected' : '')) : '' }}>{{ $item->judul }}</option>
            @endforeach
        </select>
        @isset($jadwal_sidang)
            <input type="hidden" name="pendaftaran_id" value="{{ $jadwal_sidang->pendaftaran_id }}">
        @endisset
        @error('pendaftaran_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="tanggal" class="col-md-3 col-form-label">Tanggal*</label>
    <div class="col-md">
        @include('components.input', [
            'type' => 'date',
            'name' => 'tanggal',
            'value' => isset($jadwal_sidang) ? $jadwal_sidang->tanggal : old('tanggal'),
            'required' => false,
            'autofocus' => true,
            'placeholder' => trans('jadwal_sidang.placeholders.tanggal'),
        ])
    </div>
</div>
<div class="form-group row">
    <label for="mulai" class="col-md-3 col-form-label">Jam Mulai*</label>
    <div class="col-md">
        @include('components.input', [
            'type' => 'time',
            'name' => 'mulai',
            'value' => isset($jadwal_sidang) ? date('H:i', strtotime($jadwal_sidang->mulai)) : old('mulai'),
            'required' => false,
            'autofocus' => false,
            'placeholder' => trans('jadwal_sidang.placeholders.mulai'),
        ])
    </div>
</div>
<div class="form-group row">
    <label for="selesai" class="col-md-3 col-form-label">Jam Selesai*</label>
    <div class="col-md">
        @include('components.input', [
            'type' => 'time',
            'name' => 'selesai',
            'value' => isset($jadwal_sidang) ? date('H:i', strtotime($jadwal_sidang->selesai)) : old('selesai'),
            'required' => false,
            'autofocus' => false,
            'placeholder' => trans('jadwal_sidang.placeholders.selesai'),
        ])
    </div>
</div>
<div class="form-group row">
    <label for="catatan" class="col-md-3 col-form-label">Catatan</label>
    <div class="col-md">
        <textarea name="catatan" id="catatan" class="form-control @error('catatan') is-invalid @enderror" placeholder="{{ trans('jadwal_sidang.placeholders.catatan') }}">{{ isset($jadwal_sidang) ? $jadwal_sidang->catatan : old('catatan') }}</textarea>
        @error('catatan')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
