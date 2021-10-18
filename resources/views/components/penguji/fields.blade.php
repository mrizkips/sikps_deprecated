<div class="form-group row">
    <label for="jenis" class="col-md-3 col-form-label">Jenis Sidang</label>
    <div class="col-md">
        <input type="text" name="jenis" id="jenis" value="{{ config('constant.jenis_sidang')[$pengujian->sidang->jenis] }}" class="form-control-plaintext" disabled>
    </div>
</div>

@for ($i = 1; $i <= 2; $i++)

<div class="form-group row">
    <label for="dosen_id" class="col-md-3 col-form-label">Dosen Penguji*</label>
    <div class="col-md">
        <select name="dosen_id" id="dosen_id" class="form-control @error('dosen_id') is-invalid @enderror">
            <option>{{ trans('penguji.placeholders.dosen_id') }}</option>
            @foreach ($dosen as $item)
                <option value="{{ $item->id }}" {{ isset($penguji) ? ($penguji->dosen_id == $item->id ? 'selected' : (old('dosen_id') == $item->id ? 'selected' : '')) : '' }}>{{ $item->user->nama }}</option>
            @endforeach
        </select>
        @error('dosen_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

@if ($pengujian->sidang->jenis == 3)
    @break
@endif

@endfor
