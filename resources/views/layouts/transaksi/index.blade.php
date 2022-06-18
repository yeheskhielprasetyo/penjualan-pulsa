    <div class="container">
        @if ($errors->any())
    <div class="alert alert-danger" style="max-width: 50%">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
    </div>

    @endif
    </div>

    <form action="{{route('transaksipulsa.store')}}" method="POST">
        @csrf
        <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="tempat_lahir">Nama</label>
                    <input type="text" class="form-control" id="no_spt" name="nama" placeholder="Masukkan Nama">
                </div>
                <div class="form-group">
                    <label for="id_pegawai ">Operator</label>
                    <select class="form-control" id="idoperator" name="operator" style="color: #8d827f">
                    <option value="">- Pilih Operator -</option>
                    @foreach ($operator as $operators)
                    <option value="{{$operators->id}}" data-harga="{{$operators->harga}}">{{$operators->nama_operator}} &nbsp; || &nbsp;  Rp. {{$operators->harga}}</option>
                    @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="tempat_lahir">Jumlah</label>
                    <input type="text" class="form-control" id="jumlah" name="jumlah" placeholder="Masukkan Jumlah">
                </div>
            <div class="form-group">
                <label for="tempat_lahir">No Hp</label>
                <input type="text" class="form-control"  name="no_hp" placeholder="Masukkan No Handphone">
            </div>
            </div>
            <div class="text-right mt-4">
                <button type="submit" class="btn btn-primary">Tambah Data</button>
            </div>
        </div>
        </div>
        <div class="container padding-top-5">
            <div class="alert alert-success" style="max-width: 50%">
                <div class="form-group mb-0">
                    <label for="tempat_lahir">Total Harga</label>
                    <input type="text" id="total" class="form-control" placeholder="0" readonly="">
                </div>
            </div>
        </div>
    </form>


<script src="{{asset('assets/js/chosen.jquery.min.js')}}"></script>
<script>
    $('#idoperator').chosen({ width: '100%' });
</script>
<script>
        $('#idoperator').on('change keyup', function (e) {
            var optionSelected = $("option:selected", this);
            var valueSelected = $(optionSelected).data("harga");
            $('#jumlah').keyup(function() {
            var jumlah = $('#jumlah').val();
            var total = parseInt(valueSelected) * parseInt(jumlah);
            $("#total").val("Rp." + " " + total);
            });
        });
</script>

