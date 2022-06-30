<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Operator;
use App\Models\Transaksi;
use App\Models\DataBarang;
use Illuminate\Http\Request;
use App\Models\DataTransaksi;
use Barryvdh\DomPDF\Facade as PDF;
// use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{

    public function laporan_operator()
    {
        if (request()->start_date || request()->end_date) {
            $start_date = Carbon::parse(request()->start_date)->toDateTimeString();
            $end_date = Carbon::parse(request()->end_date)->toDateTimeString();
            $datatransaksi = DataTransaksi::with('transaksi.operator')->whereBetween('tanggal_transaksi',[$start_date,$end_date])->get();
        } else {
            $datatransaksi = DataTransaksi::with('transaksi.operator')->latest('tanggal_transaksi')->get();
        }
        $no = 1;
        return view('layouts.admin.laporanoperator.index', [
            'datatransaksi' => $datatransaksi,
            'no' => $no
        ]);
    }


    public function download_operator()
    {
        $no = 1;
        $datatransaksi = DataTransaksi::with('transaksi.operator')->latest('tanggal_transaksi')->get();
        $pdf = PDF::loadView('layouts.admin.laporanoperator.cetak', ['datatransaksi' => $datatransaksi, 'no' => $no])
        ->setPaper('F4', 'landscape');
        return $pdf->download('laporan-operator.pdf');
    }

    public function laporan_aksesoris()
    {
        if (request()->start_date || request()->end_date) {
            $start_date = Carbon::parse(request()->start_date)->toDateTimeString();
            $end_date = Carbon::parse(request()->end_date)->toDateTimeString();
            $datatransaksi = DataTransaksi::with('transaksi.barang')->whereBetween('tanggal_transaksi',[$start_date,$end_date])->get();
        } else {
            $datatransaksi = DataTransaksi::with('transaksi.barang')->latest('tanggal_transaksi')->get();
        }
        $no = 1;
        return view('layouts.admin.laporanaksesoris.index', [
            'datatransaksi' => $datatransaksi,
            'no' => $no
        ]);
    }

    public function download_aksesoris()
    {
        $no = 1;
        $datatransaksi = DataTransaksi::with('transaksi.barang')->latest('tanggal_transaksi')->get();
        $pdf = PDF::loadView('layouts.admin.laporanaksesoris.cetak', ['datatransaksi' => $datatransaksi, 'no' => $no])
        ->setPaper('F4', 'landscape');
        return $pdf->download('laporan-aksesoris.pdf');
    }
}
