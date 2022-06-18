<!-- Modal -->
<div class="modal fade show" id="modal-editharga" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Data Harga</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('data_barang.update', $data->id) }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Nama Barang</label>
                    <input type="text" class="form-control" id="recipient-name"  name="nama_barang" value="{{$data->nama_barang}}">
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Harga Barang</label>
                    <input type="text" class="form-control" id="recipient-name"  name="harga_barang" value="{{$data->harga_barang}}">
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Jenis Barang</label>
                    <input type="text" class="form-control" id="recipient-name"  name="jenis_barang" value="{{$data->jenis_barang}}">
                </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                    </div>
            </form>
        </div>

    </div>
    </div>
</div>
<script>
    $("#modal-editharga").modal('show');
        $.fn.modal.Constructor.prototype._enforceFocus = function() {
            $(document).off('focusin.bs.modal').on('focusin.bs.modal');
        };
</script>
