@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <section class="section">
        <div class="card" style="width:100%;">
            <div class="card-body">
                <h2 class="card-title" style="color: black;">Laporan Aksesoris</h2>
                <hr>
                <form action="{{route('laporan.operator')}}" method="GET">
                    <div class="input-group mb-3">
                        <input type="date" class="form-control" name="start_date">
                        <input type="date" class="form-control" name="end_date">
                        <button class="btn btn-primary" type="submit">Pilih</button>
                    </div>
                </form>
                <a href="{{route('download.aksesoris')}}" class="btn btn-success">Cetak Laporan
                    Aksesoris ⭢</a>
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
                <th scope="col">Aksesoris</th>
                <th scope="col">Total Harga</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($datatransaksi as $datatransaksis)
                @if($datatransaksis->transaksi->id_barang != null)
                <tr>
                        <td>{{$no++}}</td>
                        <td>{{ \Carbon\Carbon::parse($datatransaksis->transaksi->created_at)->translatedFormat('l, d F Y')}}</td>
                        <td>{{$datatransaksis->transaksi->nama}}</td>
                        <td>{{$datatransaksis->transaksi->barang->nama_barang}}</td>
                        <td>Rp. {{$datatransaksis->transaksi->jumlah_aksesoris *= $datatransaksis->transaksi->barang->harga_barang}}</td>
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



