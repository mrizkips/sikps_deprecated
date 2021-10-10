<button type="button" class="btn btn-outline-primary btn-sm" title="Tentukan Dosen" data-toggle="modal" data-target="#assignModal{{ $id }}"><i class="cil-education"></i></button>
<div class="modal fade" id="assignModal{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="assignModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ $url }}" method="post" onsubmit="return confirm('Apakah Anda yakin akan melakukan aksi ini?');">
                <div class="modal-header">
                    <h5 class="modal-title" id="assignModalLabel">Menentukan Dosen Pembimbing</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    @method('POST')
                    <select name="dosen_id" id="dosen_id" class="form-control">
                        @foreach ($dosen as $item)
                            <option value="{{ $item->id }}">{{ $item->user->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
