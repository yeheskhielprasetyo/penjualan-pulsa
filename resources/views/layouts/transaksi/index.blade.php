    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger" style="max-width: 50%">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>


    <form action="{{route('transaksipulsa.store')}}" method="POST">
        @csrf
        <div class="container">
        <div class="row">
            <h6 class="text-left mb-4">Isi Pulsa</h6><br>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="tempat_lahir">Nama</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="no_spt" name="nama" placeholder="Masukkan Nama">
                    @error('nama')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror

                </div>
                <div class="form-group">
                    <label for="id_pegawai ">Operator</label>
                    <select class="form-control @error('operator') is-invalid @enderror" id="idoperator" name="operator" style="color: #8d827f">
                    {{-- <input type="hidden" id="operator" value="0"> --}}
                    <option value="">- Pilih Operator -</option>
                    @foreach ($operator as $operators)
                    <option value="{{$operators->id}}" data-harga="{{$operators->harga}}">{{$operators->nama_operator}} &nbsp; || &nbsp;  Rp. {{$operators->harga}}</option>
                    @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="tempat_lahir">Jumlah Pulsa</label>
                    <input type="text" class="form-control @error('jumlah') is-invalid @enderror" id="jumlah" name="jumlah" placeholder="Masukkan Jumlah">
            </div>
            <div class="form-group mb-5">
                <label for="tempat_lahir">No Hp</label>
                <input type="text" class="form-control @error('no_hp') is-invalid @enderror" name="no_hp" placeholder="Masukkan No Handphone">
            </div>
            </div>
            <h6 class="text-left mb-4">Aksesoris</h6><br>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="id_pegawai ">Aksesoris</label>
                    <select class="form-control @error('barang') is-invalid @enderror" id="idaksesoris" name="barang"  style="color: #8d827f">
                        {{-- <input type="hidden" id="aksesoris" value="0"> --}}
                        <option value="">- Pilih Aksesoris -</option>
                        @foreach ($data_barang as $datas)
                            <option value="{{$datas->id}}" data-hargaaksesoris="{{$datas->harga_barang}}">{{$datas->nama_barang}} &nbsp; || &nbsp;  Rp. {{$datas->harga_barang}} &nbsp; || &nbsp;  Jenis : {{$datas->jenis_barang}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="tempat_lahir">Jumlah Aksesoris</label>
                    <input type="text" class="form-control @error('jumlah_aksesoris') is-invalid @enderror" id="banyak" name="jumlah_aksesoris" placeholder="Masukkan Jumlah">
                </div>
            </div>
            <div class="text-right mt-4">
                <button type="submit" class="btn btn-primary">Tambah Data</button>
            </div>
        </div>
        </div>
        <div class="container padding-top-1">
            <div class="alert alert-success" style="max-width: 40%">
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
    $('#idaksesoris').chosen({ width: '100%' });
</script>
<script>
        /**
         * Untuk menjalankan fungsi hitung di semua inputan
         * Supaya tidak terlalu banyak memakan script, sehingga
         * kinerja web nggak terlalu berat
         */
        function runCounter() {
            // Mengambil Data dari "#idoperator" apabila selectnya ada atribut data-harga maka tampilkan, kalau tidak maka set ke 0
            let hPulsa     = $("#idoperator option:selected").data('harga') !== undefined ? +$("#idoperator option:selected").data('harga') : 0;
            // Mengambil data dari "#jumlah"
            let jPulsa     = +$('#jumlah').val();
            // Mengambil Data dari "#idaksesoris" apabila selectnya ada atribut data-hargaaksesoris maka tampilkan, kalau tidak maka set ke 0
            let hAksesoris = $("#idaksesoris option:selected").data('hargaaksesoris') !== undefined ? +$("#idaksesoris option:selected").data('hargaaksesoris') : 0;
            // Mengambil data dari "#banyak"
            let jAksesoris = +$('#banyak').val();

            let total = (hPulsa * jPulsa) + (hAksesoris * jAksesoris); // Hitung Harga totalnya (metode asosiatif)
            $("#total").val("Rp." + " " + total); // Tampilkan ke webnya
        }

        // Jalankan trigger "runCounter" diatas apabila ada select item yang berubah
        $('select').change(function() {
            runCounter()
        });
        // Jalankan trigger "runCounter" diatas apabila ada inputan yang telah diketik
        $('#banyak, #jumlah').keyup(function() {
            runCounter();
        });
</script>


