<?php

namespace App\Http\Controllers;

use App\Models\DataBarang;
use App\Models\DetailTransaksiAksesoris;
use App\Models\Laporan;
use App\Models\Operator;
use App\Models\Transaksi;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $operator = Operator::all();
        $data_barang = DataBarang::all();
        $transaksi = Transaksi::latest()->limit(1)->pluck('total_harga')->implode('total_harga');
        // $transaksiaksesoris = DetailTransaksiAksesoris::latest()->limit(1)->pluck('total')->implode('total');
        // $total = $transaksi + $transaksiaksesoris;
        return view('layouts.index', [
            'operator' => $operator,
            'data_barang' => $data_barang,
            // 'transaksitotal' => $total,
            'transaksi' => $transaksi,
            // 'transaksiaksesoris' => $transaksiaksesoris
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'jumlah' => 'required',
            'no_hp' => 'required'
        ]);

        try {
            $operator = Operator::find($request->operator);
            $transaksi = new Transaksi();
            $transaksi->nama = $request->nama;
            $transaksi->id_operator = $request->operator;
            $transaksi->jumlah = $request->jumlah;
            $transaksi->no_hp = $request->no_hp;
            $transaksi->total_harga = $operator->harga->harga *= $request->jumlah;
            $tanggaljam = Carbon::now();
            $transaksi->created_at = $tanggaljam->toDateTimeString();
            if ($request->jumlah >= $operator->stock) {
                Alert::warning('Gagal!', 'Stock Tidak Mencukupi');
                return redirect()->back();
            } else {
                $operator->stock -= $request->jumlah;
            }
            $operator->save();
            $transaksi->save();

            // $laporan = Laporan::where('id_operator', $transaksi->id_operator)
            //     ->where('waktu', '==', Carbon::parse($transaksi->created_at)->translatedFormat('Y-m-d'))->get();
            // dd($laporan);

            // if ($laporan > 0) {
            //     $operators = Operator::find($request->waktu);
            //     $laporan = new Laporan();
            //     $laporan->id_operator = $operators->id;
            //     $tanggaljam = Carbon::now();
            //     $laporan->waktu =  $tanggaljam->toDateTimeString();
            //     $laporan->total_penjualan = $operators->stock;
            //     $laporan->save();
            // }
            Alert::success('Berhasil!', 'menambah data');
            return redirect()->back();
        } catch (Exception $e) {
            Alert::warning('Gagal!', 'menambah data');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
