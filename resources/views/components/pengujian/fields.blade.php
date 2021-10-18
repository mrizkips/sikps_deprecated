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
    <label for="tanggal" class="col-md-3 col-form-label">Tanggal*</label>
    <div class="col-md">
        @include('components.input', [
            'type' => 'date',
            'name' => 'tanggal',
            'value' => isset($pengujian) ? $pengujian->tanggal : old('tanggal'),
            'required' => false,
            'autofocus' => false,
            'placeholder' => trans('pengujian.placeholders.tanggal'),
        ])
    </div>
</div>
<div class="form-group row">
    <label for="mulai" class="col-md-3 col-form-label">Jam Mulai*</label>
    <div class="col-md">
        @include('components.input', [
            'type' => 'time',
            'name' => 'mulai',
            'value' => isset($pengujian) ? date('H:i', strtotime($pengujian->mulai)) : old('mulai'),
            'required' => false,
            'autofocus' => false,
            'placeholder' => trans('pengujian.placeholders.mulai'),
        ])
    </div>
</div>
<div class="form-group row">
    <label for="selesai" class="col-md-3 col-form-label">Jam Selesai*</label>
    <div class="col-md">
        @include('components.input', [
            'type' => 'time',
            'name' => 'selesai',
            'value' => isset($pengujian) ? date('H:i', strtotime($pengujian->selesai)) : old('selesai'),
            'required' => false,
            'autofocus' => false,
            'placeholder' => trans('pengujian.placeholders.selesai'),
        ])
    </div>
</div>
<div class="form-group row">
    <label for="ruangan" class="col-md-3 col-form-label">Ruangan*</label>
    <div class="col-md">
        @include('components.input', [
            'type' => 'text',
            'name' => 'ruangan',
            'value' => isset($pengujian) ? $pengujian->ruangan : old('ruangan'),
            'required' => false,
            'autofocus' => false,
            'placeholder' => trans('pengujian.placeholders.ruangan'),
        ])
    </div>
</div>

@section('javascript')
<script>
    $('#pendaftaran_id').on('change', function() {
        $.ajax({
            url: '{{ route('admin.pengujian.create') }}',
            data: 'pendaftaran_id=' + this.value,
            success: function(result, data, xhr) {
                $('#sidang_id').html(result)
            }
        });
    });
</script>
@endsection
