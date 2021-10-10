<button type="button" class="btn btn-outline-success btn-sm" title="Setuju" data-toggle="modal" data-target="#approveModal{{ $id }}"><i class="cil-check"></i></button>
<div class="modal fade" id="approveModal{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="approveModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ $url }}" method="post" onsubmit="return confirm('Apakah Anda yakin akan melakukan aksi ini?');">
                <div class="modal-header">
                    <h5 class="modal-title" id="approveModalLabel">Menyetujui Sidang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    @method('POST')
                    <input type="hidden" value="1" name="tipe">
                    <textarea name="catatan" id="catatan" class="form-control" placeholder="Catatan.. (Tidak wajib diisi)"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success">Setuju</button>
                </div>
            </form>
        </div>
    </div>
</div>
