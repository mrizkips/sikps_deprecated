<div class="form-group row">
    <label for="pendaftaran_id" class="col-md-3 col-form-label">Periode Pendaftaran*</label>
    <div class="col-md">
        <select name="pendaftaran_id" id="pendaftaran_id" class="form-control @error('pendaftaran_id') is-invalid @enderror" @isset($pengujian)disabled @endisset>
            <option>{{ trans('pengujian.placeholders.pendaftaran_id') }}</option>
            @foreach ($pendaftaran as $item)
                <option value="{{ $item->id }}" {{ isset($pengujian) ? ($pengujian->sidang->pendaftaran_id == $item->id ? 'selected' : (old('pendaftaran_id') == $item->id ? 'selected' : '')) : '' }}>{{ $item->judul }}</option>
            @endforeach
        </select>
        @isset($pengujian)
            <input type="hidden" name="pendaftaran_id" value="{{ $pengujian->sidang->pendaftaran_id }}">
        @endisset
        @error('pendaftaran_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="jadwal_sidang_id" class="col-md-3 col-form-label">Jadwal Sidang*</label>
    <div class="col-md">
        <select name="jadwal_sidang_id" id="jadwal_sidang_id" class="form-control @error('jadwal_sidang_id') is-invalid @enderror" @isset($pengujian)disabled @endisset>
            <option>{{ trans('pengujian.placeholders.jadwal_sidang_id') }}</option>
            @foreach ($jadwal_sidang as $item)
                <option value="{{ $item->id }}" {{ isset($pengujian) ? ($pengujian->jadwal_sidang_id == $item->id ? 'selected' : (old('jadwal_sidang_id') == $item->id ? 'selected' : '')) : '' }}>{{ date_format_id($item->tanggal) }} ({{ date('H:i', strtotime($item->mulai)) }} - {{ date('H:i', strtotime($item->selesai)) }})</option>
            @endforeach
        </select>
        @isset($pengujian)
            <input type="hidden" name="jadwal_sidang_id" value="{{ $pengujian->jadwal_sidang_id }}">
        @endisset
        @error('jadwal_sidang_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="sidang_id" class="col-md-3 col-form-label">Pengajuan Sidang*</label>
    <div class="col-md">
        <select name="sidang_id" id="sidang_id" class="form-control @error('sidang_id') is-invalid @enderror" @isset($pengujian)disabled @endisset>
            <option>{{ trans('pengujian.placeholders.sidang_id') }}</option>
            @foreach ($sidang as $item)
                <option value="{{ $item->id }}" {{ isset($pengujian) ? ($pengujian->sidang_id == $item->id ? 'selected' : (old('sidang_id') == $item->id ? 'selected' : '')) : '' }}>{{ $item->proposal->judul }} - {{ $item->proposal->mahasiswa->user->nama }}</option>
            @endforeach
        </select>
        @isset($pengujian)
            <input type="hidden" name="sidang_id" value="{{ $pengujian->sidang_id }}">
        @endisset
        @error('sidang_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="dosen_id" class="col-md-3 col-form-label">Dosen Penguji*</label>
    <div class="col-md">
        <select name="dosen_id" id="dosen_id" class="form-control @error('dosen_id') is-invalid @enderror" @auth('dosen') disabled @endauth>
            <option>{{ trans('pengujian.placeholders.dosen_id') }}</option>
            @foreach ($dosen as $item)
                <option value="{{ $item->id }}" {{ isset($pengujian) ? ($pengujian->dosen_id == $item->id ? 'selected' : (old('dosen_id') == $item->id ? 'selected' : '')) : '' }}>{{ $item->user->nama }}</option>
            @endforeach
        </select>
        @auth('dosen')
            <input type="hidden" name="dosen_id" value="{{ $pengujian->dosen_id }}">
        @endauth
        @error('dosen_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
@auth('dosen')
<div class="form-group row">
    <label for="nilai_ppt" class="col-md-3 col-form-label">Nilai Presentasi*</label>
    <div class="col-md">
        @include('components.input', [
            'type' => 'number',
            'name' => 'nilai_ppt',
            'value' => isset($pengujian) ? $pengujian->nilai_ppt : old('nilai_ppt'),
            'required' => false,
            'autofocus' => false,
            'placeholder' => trans('pengujian.placeholders.nilai_ppt'),
        ])
    </div>
</div>
<div class="form-group row">
    <label for="nilai_laporan" class="col-md-3 col-form-label">Nilai Laporan*</label>
    <div class="col-md">
        @include('components.input', [
            'type' => 'number',
            'name' => 'nilai_laporan',
            'value' => isset($pengujian) ? $pengujian->nilai_laporan : old('nilai_laporan'),
            'required' => false,
            'autofocus' => false,
            'placeholder' => trans('pengujian.placeholders.nilai_laporan'),
        ])
    </div>
</div>
<div class="form-group row">
    <label for="nilai_aplikasi" class="col-md-3 col-form-label">Nilai Aplikasi*</label>
    <div class="col-md">
        @include('components.input', [
            'type' => 'number',
            'name' => 'nilai_aplikasi',
            'value' => isset($pengujian) ? $pengujian->nilai_aplikasi : old('nilai_ppt'),
            'required' => false,
            'autofocus' => false,
            'placeholder' => trans('pengujian.placeholders.nilai_aplikasi'),
        ])
    </div>
</div>
@endauth

@section('javascript')
<script>
    $('#pendaftaran_id').on('change', function() {
        $.ajax({
            url: '{{ route('admin.pengujian.create') }}',
            data: 'pendaftaran_id=' + this.value,
            success: function(result, data, xhr) {
                $('#jadwal_sidang_id').html(result[0])
                $('#sidang_id').html(result[1])
            }
        });
    });
</script>
@endsection
