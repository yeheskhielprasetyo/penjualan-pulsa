    <div class="container">
        @if ($errors->any())
    <div class="alert alert-danger" style="max-width: 50%">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
    </div>
    @endif
    </div>
    <form action="{{route('transaksipulsa.aksesoris')}}" method="POST">
        @csrf
        <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="id_pegawai ">Aksesoris</label>
                    <select class="form-control" id="idaksesoris" name="barang" required  style="color: #8d827f">
                        <option value="">- Pilih Aksesoris -</option>
                        @foreach ($data_barang as $datas)
                            <option value="{{$datas->id}}" data-hargaaksesoris="{{$datas->harga_barang}}">{{$datas->nama_barang}} &nbsp; || &nbsp;  Rp. {{$datas->harga_barang}} &nbsp; || &nbsp;  Jenis : {{$datas->jenis_barang}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="tempat_lahir">Banyak</label>
                    <input type="text" class="form-control" id="banyak" name="banyak" placeholder="Masukkan Jumlah">
                </div>
            </div>
                <div class="text-right mt-4">
                    <button type="submit" class="btn btn-primary">Tambah Data</button>
                </div>
        </div>
        <div class="container padding-top-5">
            <div class="alert alert-success" style="max-width: 50%">
                <div class="form-group mb-0">
                    <label for="tempat_lahir">Total Harga</label>
                    <input type="text" id="totalaksesoris" class="form-control" placeholder="0" readonly="">
                </div>
            </div>
        </div>
    </form>

<script src="{{asset('assets/js/chosen.jquery.min.js')}}"></script>
<script>
    $('#idaksesoris').chosen({ width: '100%' });
</script>
<script>
    $('#idaksesoris').on('change keyup', function (e) {
        var optionSelectedaksesoris = $("option:selected", this);
        var valueSelectedaksesoris = $(optionSelectedaksesoris).data("hargaaksesoris");
        $('#banyak').keyup(function() {
        var banyak = $('#banyak').val();
        var totalaksesoris = parseInt(valueSelectedaksesoris) * parseInt(banyak);
        $("#totalaksesoris").val("Rp." + " " + totalaksesoris);
        });
    });
</script>

