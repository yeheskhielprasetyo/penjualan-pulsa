<?php

namespace App\Http\Controllers;

use App\Models\DataBarang;
use App\Models\DataTransaksi;
use App\Models\Harga;
use App\Models\Operator;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        // $harga = Harga::all()->count();
        $operator = Operator::all()->count();
        $aksesoris = DataBarang::all()->count();
        $pelanggan = Transaksi::all()->count();
        $datakonfirmasi = DataTransaksi::all()->count();
        $datapending = Transaksi::where('status', '=', 'PENDING')->count();
        return view('layouts.admin.dashboard.dashboard', [
            // 'harga' => $harga,
            'operator' => $operator,
            'pelanggan' => $pelanggan,
            'datakonfirmasi' => $datakonfirmasi,
            'datapending' => $datapending,
            'aksesoris' => $aksesoris
        ]);
    }
}
