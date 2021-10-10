<div class="form-group row">
    <label for="judul" class="col-md-3 col-form-label">Judul*</label>
    <div class="col-md">
        @include('components.input', [
            'type' => 'text',
            'name' => 'judul',
            'value' => isset($proposal) ? $proposal->judul : old('judul'),
            'required' => false,
            'autofocus' => true,
            'placeholder' => trans('proposal.placeholders.judul'),
        ])
    </div>
</div>
<div class="form-group row">
    <label for="jenis" class="col-md-3 col-form-label">Jenis*</label>
    <div class="col-md">
        <select name="jenis" id="jenis" class="form-control @error('jenis') is-invalid @enderror">
            <option>{{ trans('proposal.placeholders.jenis') }}</option>
            @foreach (config('constant.jenis_proposal') as $key => $value)
                <option value="{{ $key }}" {{ isset($proposal) ? ($proposal->jenis == $key ? 'selected' : (old('jenis') == $key ? 'selected' : '')) : '' }}>{{ $value }}</option>
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
    <label for="dokumen" class="col-md-3 col-form-label">Dokumen Proposal @if(!isset($proposal))*@endif</label>
    <div class="col-md">
        @include('components.input', [
            'type' => 'file',
            'name' => 'dokumen',
            'value' => isset($proposal) ? $proposal->dokumen : old('dokumen'),
            'required' => false,
            'autofocus' => true,
            'placeholder' => trans('proposal.placeholders.dokumen'),
        ])
        <small class="form-text text-muted" for="dokumen">
            Format file berupa pdf, maks. 2MB.
        </small>
    </div>
</div>
<div class="form-group row">
    <label for="pendaftaran_id" class="col-md-3 col-form-label">Periode Pendaftaran*</label>
    <div class="col-md">
        <select name="pendaftaran_id" id="pendaftaran_id" class="form-control @error('pendaftaran_id') is-invalid @enderror" @isset($proposal)disabled @endisset>
            <option>{{ trans('proposal.placeholders.pendaftaran_id') }}</option>
            @foreach ($pendaftaran as $item)
                <option value="{{ $item->id }}" {{ isset($proposal) ? ($proposal->pendaftaran_id == $item->id ? 'selected' : (old('pendaftaran_id') == $item->id ? 'selected' : '')) : '' }}>{{ $item->judul }}</option>
            @endforeach
        </select>
        @isset($proposal)
            <input type="hidden" name="pendaftaran_id" value="{{ $proposal->pendaftaran_id }}">
        @endisset
        @error('pendaftaran_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="form-group row" id="field_kp">
    <label for="tempat_kp" class="col-md-3 col-form-label">Tempat KP*</label>
    <div class="col-md">
        @include('components.input', [
            'type' => 'text',
            'name' => 'tempat_kp',
            'value' => isset($proposal) ? $proposal->tempat_kp : old('tempat_kp'),
            'required' => false,
            'autofocus' => false,
            'placeholder' => trans('proposal.placeholders.tempat_kp'),
        ])
        <small class="form-text text-muted" for="tempat_kp">
            Wajib diisi apabila jenisnya kerja praktek.
        </small>
    </div>
</div>

@section('javascript')
<script>
    $(document).ready(function() {
        $('#field_kp').hide()
    });

    $('#jenis').on('change', function() {
        value = $(this).val()
        field = $('#field_kp')

        if (value == 2) {
            field.slideDown()
        } else {
            field.slideUp()
        }
    });
</script>
@endsection
