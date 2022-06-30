<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Laporan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body>
    <div class="content-wrapper">
        <section class="section">
            <div class="card" style="width:100%;">
                <div class="card-body">
                    <h2 class="card-title" style="color: black;">Laporan Operator</h2>
                    <a href="{{route('download.operator')}}" class="btn btn-success">Cetak Laporan
                        Operator</a>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="bg-white p-4" style="border-radius:3px;box-shadow:rgba(0, 0, 0, 0.03) 0px 4px 8px 0px">
        <div class="container">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Nama Pembeli</th>
                        <th scope="col">Operator</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">No Hp</th>
                        <th scope="col">Total Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datatransaksi as $datatransaksis)
                @if($datatransaksis->transaksi->id_operator != null)
                <tr>
                        <td>{{$no++}}</td>
                        <td>{{ \Carbon\Carbon::parse($datatransaksis->transaksi->created_at)->translatedFormat('l, d F Y')}}</td>
                        <td>{{$datatransaksis->transaksi->nama}}</td>
                        <td>{{$datatransaksis->transaksi->operator->nama_operator}}</td>
                        <td>{{$datatransaksis->transaksi->jumlah}}</td>
                        <td>{{$datatransaksis->transaksi->no_hp}}</td>
                        <td>{{$datatransaksis->transaksi->jumlah *= $datatransaksis->transaksi->operator->harga}}</td>
                </tr>
                @endif
            @endforeach
                </tbody>
                </table>
        </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
</body>
</html>





