<div class="form-group row">
    <label for="nama" class="col-md-3 col-form-label">Nama Form</label>
    <div class="col-md">
        <input type="text" name="nama" id="nama" value="{{ $penilaian->form_penilaian->nama }}" class="form-control-plaintext" disabled>
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
<div class="form-group row">
    <label for="judul" class="col-md-3 col-form-label">Penilai</label>
    <div class="col-md">
        <input type="text" name="judul" id="judul" value="{{ config('constant.penilai')[$penilaian->form_penilaian->penilai] }}" class="form-control-plaintext" disabled>
    </div>
</div>
@foreach ($penilaian->penilaian_item as $item)
<div class="form-group row">
    <label for="{{$item->form_penilaian_item->nama}}" class="col-md-3 col-form-label">{{$item->form_penilaian_item->nama}}</label>
    <div class="col-md">
        <input type="text" name="{{$item->form_penilaian_item->nama}}" id="{{$item->form_penilaian_item->nama}}" value="{{ $item->nilai ?? $item->keterangan }}" class="form-control-plaintext" disabled>
    </div>
</div>
@endforeach
