<div class="form-group row">
    <label for="jenis" class="col-md-3 col-form-label">Jenis*</label>
    <div class="col-md">
        <select name="jenis" id="jenis" class="form-control @error('jenis') is-invalid @enderror" autofocus @isset($sidang)disabled @endisset>
            <option>{{ trans('sidang.placeholders.jenis') }}</option>
            @foreach (config('constant.jenis_sidang') as $key => $value)
                <option value="{{ $key }}" {{ isset($sidang) ? ($sidang->jenis == $key ? 'selected' : (old('jenis') == $key ? 'selected' : '')) : '' }}>{{ $value }}</option>
            @endforeach
        </select>
        @isset($sidang)
            <input type="hidden" name="jenis" value="{{ $sidang->jenis }}">
        @endisset
        @error('jenis')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="proposal_id" class="col-md-3 col-form-label">Proposal*</label>
    <div class="col-md">
        <select name="proposal_id" id="proposal_id" class="form-control @error('proposal_id') is-invalid @enderror" @isset($sidang)disabled @endisset>
            <option>{{ trans('sidang.placeholders.proposal_id') }}</option>
            @foreach ($proposal as $item)
                <option value="{{ $item->id }}" {{ isset($sidang) ? ($sidang->proposal_id == $item->id ? 'selected' : (old('proposal_id') == $item->id ? 'selected' : '')) : '' }}>{{ $item->judul }}</option>
            @endforeach
        </select>
        @isset($sidang)
            <input type="hidden" name="proposal_id" value="{{ $sidang->proposal_id }}">
        @endisset
        @error('proposal_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="laporan" class="col-md-3 col-form-label">File Laporan @if(!isset($sidang))*@endif</label>
    <div class="col-md">
        @include('components.input', [
            'type' => 'file',
            'name' => 'laporan',
            'value' => isset($sidang) ? $sidang->laporan : old('laporan'),
            'required' => false,
            'autofocus' => false,
            'placeholder' => trans('sidang.placeholders.laporan'),
        ])
        <small class="form-text text-muted" for="laporan">
            Format file berupa pdf, maks. 2MB.
        </small>
    </div>
</div>
<div class="form-group row" id="field_kp">
    <label for="penilaian_kp" class="col-md-3 col-form-label">Form Penilaian KP @if(!isset($sidang))*@endif</label>
    <div class="col-md">
        @include('components.input', [
            'type' => 'file',
            'name' => 'penilaian_kp',
            'value' => isset($sidang) ? $sidang->penilaian_kp : old('penilaian_kp'),
            'required' => false,
            'autofocus' => false,
            'placeholder' => trans('sidang.placeholders.penilaian_kp'),
        ])
        <small class="form-text text-muted" for="penilaian_kp">
            Format file berupa pdf, maks. 10MB.
        </small>
    </div>
</div>
<div class="form-group row">
    <label for="pendaftaran_id" class="col-md-3 col-form-label">Periode Pendaftaran*</label>
    <div class="col-md">
        <select name="pendaftaran_id" id="pendaftaran_id" class="form-control @error('pendaftaran_id') is-invalid @enderror" @isset($sidang)disabled @endisset>
            <option>{{ trans('sidang.placeholders.pendaftaran_id') }}</option>
            @foreach ($pendaftaran as $item)
                <option value="{{ $item->id }}" {{ isset($sidang) ? ($sidang->pendaftaran_id == $item->id ? 'selected' : (old('pendaftaran_id') == $item->id ? 'selected' : '')) : '' }}>{{ $item->judul }}</option>
            @endforeach
        </select>
        @isset($sidang)
            <input type="hidden" name="pendaftaran_id" value="{{ $sidang->pendaftaran_id }}">
        @endisset
        @error('pendaftaran_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="catatan" class="col-md-3 col-form-label">Catatan</label>
    <div class="col-md">
        <textarea name="catatan" id="catatan" class="form-control @error('catatan') is-invalid @enderror" placeholder="{{ trans('sidang.placeholders.catatan') }}">{{ isset($sidang) ? $sidang->catatan : old('catatan') }}</textarea>
        @error('catatan')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
@section('javascript')
<script>
    $(document).ready(function() {
        $('#field_kp').hide()

        jenis = $('input[name="jenis"]')
        console.log(jenis);
        if (jenis.val() === '3') {
            $('#field_kp').show()
        }
    });

    $('#jenis').on('change', function() {
        value = this.value
        field = $('#field_kp')

        if (value == 3) {
            field.slideDown()
        } else {
            field.slideUp()
        }

        $.ajax({
            url: '{{ route('mahasiswa.sidang.create') }}',
            data: 'jenis=' + value,
            success: function(result, data, xhr) {
                $('#proposal_id').html(result);
            }
        });
    });
</script>
@endsection
