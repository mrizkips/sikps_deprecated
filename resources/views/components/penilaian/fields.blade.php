<div class="form-group row">
    <label for="nama" class="col-md-3 col-form-label">Nama Form</label>
    <div class="col-md">
        <input type="text" name="nama" id="nama" value="{{ $form_penilaian->nama }}" class="form-control-plaintext" disabled>
    </div>
</div>
<div class="form-group row">
    <label for="nama" class="col-md-3 col-form-label">Nama Mahasiswa</label>
    <div class="col-md">
        <input type="text" name="nama" id="nama" value="{{ $pengujian->sidang->proposal->mahasiswa->user->nama }}" class="form-control-plaintext" disabled>
    </div>
</div>
<div class="form-group row">
    <label for="judul" class="col-md-3 col-form-label">Judul Proposal</label>
    <div class="col-md">
        <input type="text" name="judul" id="judul" value="{{ $pengujian->sidang->proposal->judul }}" class="form-control-plaintext" disabled>
    </div>
</div>
<input type="hidden" name="form_penilaian_id" class="d-none" value="{{ $form_penilaian->id }}">
@foreach ($form_penilaian->form_penilaian_item as $key => $item)
<div class="form-group row">
    <label for="{{ str_replace([' '],'_',$item->nama) }}" class="col-md-3 col-form-label">{{ $item->nama }}*</label>
    <div class="col-md">
        @include('components.input', [
            'type' => isset($item->min) ? 'number' : 'text',
            'name' => str_replace([' '],'_',$item->nama),
            'value' => isset($penilaian) ? $penilaian->penilaian_item[$key]->nilai : old(str_replace([' '],'_',$item->nama)),
            'required' => false,
            'autofocus' => false,
            'placeholder' => isset($item->min) ? "Nilai {$item->min} - {$item->max}" : $item->nama,
        ])
        <input type="hidden" name="{{ str_replace([' '],'_',$item->nama)."_id" }}" value="{{ $item->id }}" class="d-none">
    </div>
</div>
@endforeach
