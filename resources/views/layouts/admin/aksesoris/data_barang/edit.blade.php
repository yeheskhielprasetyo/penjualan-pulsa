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
                <div class="form-group">
                    <label for="editsatuan ">Satuan</label>
                    <select class="form-control @error('satuan') is-invalid @enderror" id="editsatuan" name="satuan" style="color: #8d827f">
                    {{-- <input type="hidden" id="operator" value="0"> --}}
                        <option value="">- Pilih Satuan -</option>
                        <option value="pcs" @if($data->satuan == 'pcs') selected @endif>Pcs</option>
                        <option value="buah" @if($data->satuan == 'buah') selected @endif>Buah</option>
                        <option value="lusin" @if($data->satuan == 'lusin') selected @endif>Lusin</option>
                    </select>
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
<script src="{{asset('assets/js/chosen.jquery.min.js')}}"></script>
<script>
    $('#editsatuan').chosen({ width: '100%' });
</script>

<script>
    $("#modal-editharga").modal('show');
        $.fn.modal.Constructor.prototype._enforceFocus = function() {
            $(document).off('focusin.bs.modal').on('focusin.bs.modal');
        };
</script>
