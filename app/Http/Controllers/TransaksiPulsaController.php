<?php

namespace App\Http\Controllers;

use App\DataTables\TransaksiPulsaDataTable;
use App\Models\DataBarang;
use App\Models\DataTransaksi;
use App\Models\DetailTransaksiAksesoris;
use App\Models\Harga;
use App\Models\Operator;
use App\Models\Stock;
use App\Models\Transaksi;
use App\Models\TransaksiPulsa;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Database\Events\TransactionRolledBack;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Illuminate\Validation\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class TransaksiPulsaController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TransaksiPulsaDataTable $dataTable)
    {
        return $dataTable->render('layouts.user.transaksi.history');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     $operator = Operator::all();
    //     $data_barang = DataBarang::all();
    //     return view('layouts.index');
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            try {

                $rules = [
                    'nama' => 'required',
                    'operator'=> 'nullable',
                    'jumlah'=> 'nullable|numeric',
                    'no_hp' => 'nullable|numeric',
                    'barang'=> 'nullable',
                    'jumlah_aksesoris'=> 'nullable|numeric',
                ];

                $pesan = [
                    'nama.required' => 'Gagal! Nama harus diisi',
                    'jumlah.numeric' => 'Gagal! jumlah harus berisikan angka',
                    'no_hp.numeric' => 'Gagal! no hp harus berisikan angka',
                    'jumlah_aksesoris.numeric' => 'Gagal! jumlah aksesoris harus berisikan angka',
                ];

                $validasi = FacadesValidator::make($request->all(), $rules, $pesan);
                if($validasi->fails()) {
                    // Alert::warning('Gagal!', 'menambahss data transaksi pulsa');
                    return redirect()->back()->withErrors($validasi)
                    ->withInput();
                } else {
                $operator = Operator::find($request->operator);
                $barang = DataBarang::find($request->barang);

                // Pindah ke atas jadi kalo gagal ga ngurangin stock
                // Ganti comparison operatornya jadi > aja gimana?
                if ($request->jumlah && $request->jumlah > $operator->stock) {
                    Alert::warning('Gagal!', 'Stock Tidak Mencukupi');
                    return redirect()->back();
                }

                $transaksi = new Transaksi();
                $totalpulsa = 0;
                $transaksi->nama = $request->nama;
                if ($operator) {
                    $transaksi->id_operator = $request->operator;
                    $transaksi->jumlah = $request->jumlah;
                    $transaksi->no_hp = $request->no_hp;
                    $operator->stock -= $request->jumlah;
                    $operator->save();
                    $totalpulsa = $operator->harga * $request->jumlah;
                }

                $totalaksesoris = 0;
                if ($barang) {
                    $transaksi->id_barang = $request->barang;
                    $transaksi->jumlah_aksesoris = $request->jumlah_aksesoris;
                    $totalaksesoris = $barang->harga_barang * $request->jumlah_aksesoris;
                }
                    $transaksi->status = 'PENDING';
                    $transaksi->total_harga = $totalaksesoris + $totalpulsa;
                    $transaksi->save();
                    Alert::success('Berhasil!', 'menambah data transaksi pulsa');
                    return redirect()->back();
                }
        } catch (Exception $e) {
            // dd($transaksi);
            // dd($e);
            Alert::warning('Gagal!', 'menambah data transaksi pulsa');
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
        try {
            $user = Auth::user()->id;
            $transaksi = Transaksi::find($id);
            $transaksi->id_user = $user;
            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move(public_path() . '/bukti_pembayaran', $filename);
                $filehapus = public_path('/bukti_pembayaran/') . $transaksi->gambar;
                if (file_exists($filehapus)) {
                    // hapus file di folder assets
                    @unlink($filehapus);
                }
                $transaksi->gambar = $filename;
            }
            $transaksi->save();
            Alert::success('Berhasil!', 'menambah data transaksi');
            return redirect()->back();
        } catch (Exception $e) {
            Alert::warning('Gagal!', 'menambah data transaksi');
            return redirect()->back();
        }
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

    public function actiontransaksi($action, $id)
    {
        $operator = Operator::all();
        $transaksi =  Transaksi::where('id', $id)->first();
        if (count($transaksi->get()) > 0) {
            if ($action == "hapus") {
                $returnHTML = view('layouts.user.transaksi.hapus', ['data' => $transaksi])->render();
                return response()->json(['html' => $returnHTML]);
            } elseif ($action == "edit") {
                $returnHTML = view('layouts.user.transaksi.edit', ['data' => $transaksi])->render();
                return response()->json(['html' => $returnHTML]);
            }
        } else {
            Alert::warning('Gagal!', 'Gagal menampilkan data transaksi');
            return redirect()->back();
        }
    }

    // public function transaksi_aksesoris(Request $request)
    // {
    //     $request->validate([
    //         'barang' => 'required',
    //         'banyak' => 'required|numeric',
    //     ],
    //     [
    //         'barang.required' => 'Barang harus diisi',
    //         'banyak.required' => 'Jumlah harus diisi',
    //         'banyak.numeric' => 'Jumlah harus berisikan angka',
    //     ]);

    //     try {
    //         // $user = Auth::user()->id;
    //         $data_barang = DataBarang::find($request->barang);
    //         $transaksi = new DetailTransaksiAksesoris();
    //         $transaksi->id_barang = $request->barang;
    //         $transaksi->banyak = $request->banyak;
    //         $transaksi->total = $data_barang->harga_barang *= $request->banyak;
    //         $transaksi->save();
    //         Alert::success('Berhasil!', 'menambah data transaksi aksesoris');
    //         return redirect()->back();
    //     } catch (Exception $e) {
    //         Alert::warning('Gagal!', 'menambah data transaksi aksesoris');
    //         return redirect()->back();
    //     }
    // }
}
