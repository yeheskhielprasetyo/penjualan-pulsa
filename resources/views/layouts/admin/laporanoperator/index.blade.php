@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <section class="section">
        <div class="card" style="width:100%;">
            <div class="card-body">
                <h2 class="card-title" style="color: black;">Laporan Operator Pulsa</h2>
                <hr>
                <form action="{{route('laporan.operator')}}" method="GET">
                    <div class="input-group mb-3">
                        <input type="date" class="form-control" name="start_date">
                        <input type="date" class="form-control" name="end_date">
                        <button class="btn btn-primary" type="submit">Pilih</button>
                    </div>
                </form>
                <a href="{{route('download.operator')}}" class="btn btn-success">Cetak Laporan
                    Operator ⭢</a>
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
                        <td>Rp. {{$datatransaksis->transaksi->jumlah *= $datatransaksis->transaksi->operator->harga}}</td>
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


@endsection



