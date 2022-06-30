<?php

namespace App\Http\Controllers;

use App\DataTables\PelangganDataTable;
use App\Models\DataTransaksi;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PelangganDataTable $dataTable)
    {
        return $dataTable->render('layouts.admin.pelanggan.index');
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
        try {
            Transaksi::where('id', $id)->delete();
            Alert::success('Berhasil!', 'menghapus data transaksi');
            return redirect()->back();
        } catch (Exception $e) {
            Alert::warning('Gagal!', 'menghapus data transaksi');
            return redirect()->back();
        }
    }

    public function action($action, $id)
    {
        $transaksi =  Transaksi::where('id', $id)->first();
        if (count($transaksi->get()) > 0) {
            if ($action == "hapus") {
                $returnHTML = view('layouts.admin.pelanggan.hapus', ['data' => $transaksi])->render();
                return response()->json(['html' => $returnHTML]);
            } elseif ($action == "konfirmasi") {
                $returnHTML = view('layouts.admin.pelanggan.konfirmasi', ['data' => $transaksi])->render();
                return response()->json(['html' => $returnHTML]);
            }
        } else {
            Alert::warning('Gagal!', 'Gagal menampilkan data transaksi');
            return redirect()->back();
        }
    }

    public function konfirmasi(Request $request, $id)
    {
        try {
            $transaksi = Transaksi::find($id);
            $konfirmasi = new DataTransaksi();
            $datenow = Carbon::now();
            $konfirmasi->tanggal_transaksi = $datenow->toDateTimeString();
            $konfirmasi->id_transaksi = $transaksi->id;
            $konfirmasi->sub_total = $transaksi->total_harga;
            $konfirmasi->save();

            if($konfirmasi){
                $transaksi->status = 'KONFIRMASI';
                $transaksi->save();
            }

            Alert::success('Berhasil!', 'konfirmasi');
            return redirect()->back();
        } catch (Exception $e) {
            dd($konfirmasi);
            Alert::warning('Gagal!', 'konfirmasiii');
            return redirect()->back();
        }
    }
}
