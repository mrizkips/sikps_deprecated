<button type="button" class="btn btn-outline-danger btn-sm" title="Tolak" data-toggle="modal" data-target="#disapproveModal{{ $id }}"><i class="cil-ban"></i></button>
<div class="modal fade" id="disapproveModal{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="disapproveModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ $url }}" method="post" onsubmit="return confirm('Apakah Anda yakin akan melakukan aksi ini?');">
                <div class="modal-header">
                    <h5 class="modal-title" id="disapproveModalLabel">Menolak Sidang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    @method('POST')
                    <input type="hidden" value="2" name="tipe">
                    <textarea name="catatan" id="catatan" class="form-control" placeholder="Catatan.. (Tidak wajib diisi)"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-danger">Tolak</button>
                </div>
            </form>
        </div>
    </div>
</div>
