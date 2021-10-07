<div class="form-group row">
    <label for="jadwal_id" class="col-md-3 col-form-label">Jadwal Bimbingan*</label>
    <div class="col-md">
        <select name="jadwal_id" id="jadwal_id" class="form-control @error('jadwal_id') is-invalid @enderror" @isset($bimbingan)disabled @endisset>
            <option>{{ trans('bimbingan.placeholders.jadwal_id') }}</option>
            @foreach ($jadwal as $item)
                <option value="{{ $item->id }}" {{ isset($bimbingan) ? ($bimbingan->jadwal_id == $item->id ? 'selected' : (old('jadwal_id') == $item->id ? 'selected' : '')) : '' }}>
                    {{ $item->dosen->user->nama }}, {{ date_format_id($item->tanggal) }} ({{ date('H:i', strtotime($item->mulai)) }} - {{ date('H:i', strtotime($item->selesai)) }})
                </option>
            @endforeach
        </select>
        @isset($bimbingan)
            <input type="hidden" name="jadwal_id" value="{{ $bimbingan->jadwal_id }}">
        @endisset
        @error('jadwal_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="proposal_id" class="col-md-3 col-form-label">Proposal*</label>
    <div class="col-md">
        <select name="proposal_id" id="proposal_id" class="form-control @error('proposal_id') is-invalid @enderror" @isset($bimbingan)disabled @endisset>
            <option>{{ trans('bimbingan.placeholders.proposal_id') }}</option>
            @foreach ($proposal as $item)
                <option value="{{ $item->id }}" {{ isset($bimbingan) ? ($bimbingan->proposal_id == $item->id ? 'selected' : (old('proposal_id') == $item->id ? 'selected' : '')) : '' }}>{{ $item->judul }}</option>
            @endforeach
        </select>
        @isset($bimbingan)
            <input type="hidden" name="proposal_id" value="{{ $bimbingan->proposal_id }}">
        @endisset
        @error('proposal_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="catatan" class="col-md-3 col-form-label">Catatan*</label>
    <div class="col-md">
        <textarea name="catatan" id="catatan" class="form-control @error('catatan') is-invalid @enderror" placeholder="{{ trans('bimbingan.placeholders.catatan') }}">{{ isset($bimbingan) ? $bimbingan->catatan : old('catatan') }}</textarea>
        @error('catatan')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="pin" class="col-md-3 col-form-label">Pin*</label>
    <div class="col-md">
        @include('components.input', [
            'type' => 'text',
            'name' => 'pin',
            'value' => isset($bimbingan) ? $bimbingan->jadwal->pin : old('pin'),
            'required' => false,
            'autofocus' => false,
            'placeholder' => trans('bimbingan.placeholders.pin'),
            'readonly' => isset($bimbingan),
        ])
    </div>
</div>
@section('javascript')
<script>
    $(document).ready(function() {
        $('#jadwal_id').on('change', function() {
            $.ajax({
                url: '{{ route('mahasiswa.bimbingan.get_proposal') }}',
                data: 'jadwal_id=' + this.value,
                success: function(result, data, xhr) {
                    $('#bimbingan_id').html(result);
                }
            });
        });
    });
</script>
@endsection
