<?php

namespace App\Http\Controllers;

use App\DataTables\DataBarangDataTable;
use App\Models\DataBarang;
use Exception;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class DataBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DataBarangDataTable $dataTable)
    {
        return $dataTable->render('layouts.admin.aksesoris.data_barang.index');
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
            'nama_barang' => 'required',
            'harga_barang' => 'required|numeric',
            'jenis_barang' => 'required',
        ],
        [
            'nama_barang.required' => 'Nama Barang harus diisi',
            'harga_barang.required' => 'Harga harus diisi',
            'harga_barang.numeric' => 'Harga harus berisikan angka',
            'jenis_barang.required' => 'Jenis harus diisi',
        ]);

        try {
            // $user = Auth::user()->id;
            $user = auth()->user()->id;
            $data_barang = new DataBarang();
            $data_barang->nama_barang = $request->nama_barang;
            $data_barang->harga_barang = $request->harga_barang;
            $data_barang->jenis_barang = $request->jenis_barang;
            $data_barang->id_user = $user;
            $data_barang->save();
            Alert::success('Berhasil!', 'menambah data barang');
            return redirect()->back();
        } catch (Exception $e) {
            Alert::warning('Gagal!', 'menambah data barang');
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
            // $user = Auth::user()->id;
            $user = auth()->user()->id;
            $data_barang = DataBarang::find($id);
            $data_barang->nama_barang = $request->nama_barang;
            $data_barang->harga_barang = $request->harga_barang;
            $data_barang->jenis_barang = $request->jenis_barang;
            $data_barang->id_user = $user;
            $data_barang->save();
            Alert::success('Berhasil!', 'merubah data barang');
            return redirect()->back();
        } catch (Exception $e) {
            Alert::warning('Gagal!', 'merubah data barang');
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
            DataBarang::where('id', $id)->delete();
            Alert::success('Berhasil!', 'menghapus data barang');
            return redirect()->back();
        } catch (Exception $e) {
            Alert::warning('Gagal!', 'menghapus data barang');
            return redirect()->back();
        }
    }

    public function action($action, $id)
    {
        // $harga = Harga::all();
        $data_barang =  DataBarang::where('id', $id)->first();
        if (count($data_barang->get()) > 0) {
            if ($action == "hapus") {
                $returnHTML = view('layouts.admin.aksesoris.data_barang.hapus', ['data' => $data_barang])->render();
                return response()->json(['html' => $returnHTML]);
            } elseif ($action == "edit") {
                $returnHTML = view('layouts.admin.aksesoris.data_barang.edit', ['data' => $data_barang])->render();
                return response()->json(['html' => $returnHTML]);
            }
        } else {
            Alert::warning('Gagal!', 'Gagal menampilkan data operator');
            return redirect()->back();
        }
    }
}
