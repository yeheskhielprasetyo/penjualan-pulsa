<?php

namespace App\Http\Controllers;

use App\Models\DataBarang;
use App\Models\DetailTransaksiAksesoris;
use App\Models\DetailTransaksiController;
use Exception;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class DetailTransaksiControllerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data_barang = DataBarang::all();
        // return view('layouts.transaksi.indexaksesoris', [
        //     'data_barang' => $data_barang
        // ]);
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
            'barang' => 'required',
            'banyak' => 'required|numeric',
        ],
        [
            'barang.required' => 'Barang harus diisi',
            'banyak.required' => 'Jumlah harus diisi',
            'banyak.numeric' => 'Jumlah harus berisikan angka',
        ]);

        try {
            // $user = Auth::user()->id;
            $data_barang = DataBarang::find($request->barang);
            $transaksi = new DetailTransaksiAksesoris();
            $transaksi->id_barang = $request->barang;
            $transaksi->banyak = $request->banyak;
            $transaksi->total = $data_barang->harga_barang *= $request->banyak;
            $transaksi->save();
            Alert::success('Berhasil!', 'menambah data transaksi aksesoris');
            return redirect()->back();
        } catch (Exception $e) {
            Alert::warning('Gagal!', 'menambah data transaksi aksesoris');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DetailTransaksiController  $detailTransaksiController
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DetailTransaksiController  $detailTransaksiController
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
     * @param  \App\Models\DetailTransaksiController  $detailTransaksiController
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DetailTransaksiController  $detailTransaksiController
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
