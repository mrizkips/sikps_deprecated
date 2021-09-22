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
            @foreach (config('constant.jenis_proposal') as $item)
                <option value="{{ $item }}" {{ isset($proposal) ? ($proposal->jenis == $item ? 'selected' : '') : '' }}>{{ $item }}</option>
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
        <small class="form-text text-muted" id="dokumen">
            Format file berupa pdf, maks. 2MB.
        </small>
    </div>
</div>
<div class="form-group row">
    <label for="pendaftaran_id" class="col-md-3 col-form-label">Periode Pendaftaran*</label>
    <div class="col-md">
        <select name="pendaftaran_id" id="pendaftaran_id" class="form-control @error('pendaftaran_id') is-invalid @enderror">
            <option>{{ trans('proposal.placeholders.pendaftaran_id') }}</option>
            @foreach ($pendaftaran as $item)
                <option value="{{ $item->id }}" {{ isset($proposal) ? ($proposal->pendaftaran_id == $item->id ? 'selected' : '') : '' }}>{{ $item->judul }}</option>
            @endforeach
        </select>
        @error('pendaftaran_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="kbb_id" class="col-md-3 col-form-label">KBB*</label>
    <div class="col-md">
        <select name="kbb_id" id="kbb_id" class="form-control @error('kbb_id') is-invalid @enderror">
            <option>{{ trans('proposal.placeholders.kbb_id') }}</option>
            @foreach ($kbb as $item)
                <option value="{{ $item->id }}" {{ isset($proposal) ? ($proposal->kbb_id == $item->id ? 'selected' : '') : '' }}>{{ $item->nama }}</option>
            @endforeach
        </select>
        @error('kbb_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="tanggal_kontrak" class="col-md-3 col-form-label">Tanggal Kontrak*</label>
    <div class="col-md">
        @include('components.input', [
            'type' => 'date',
            'name' => 'tanggal_kontrak',
            'value' => isset($proposal) ? $proposal->tanggal_kontrak : old('tanggal_kontrak'),
            'required' => false,
            'autofocus' => false,
            'placeholder' => trans('proposal.placeholders.tanggal_kontrak'),
        ])
    </div>
</div>
