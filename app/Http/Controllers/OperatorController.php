<?php

namespace App\Http\Controllers;

use App\DataTables\OperatorDataTable;
use App\Models\Harga;
use App\Models\Operator;
use Exception;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class OperatorController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(OperatorDataTable $dataTable)
    {
        // $harga = Harga::all();
        return $dataTable->render('layouts.admin.operator.index');
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
            'nama_operator' => 'required',
            'stock' => 'required|numeric',
            'harga' => 'required|numeric'
        ],

        [
            'nama_operator.required' => 'Gagal! Nama Operator harus diisi',
            'stock.required' => 'Gagal! Stock harus diisi',
            'stock.numeric' => 'Gagal! Stock harus berisikan angka',
            'harga.required' => 'Gagal! Harga harus diisi',
            'harga.numeric' => 'Gagal! Harga harus berisikan angka'
        ]);

        try {
            $user = auth()->user()->id;
            $operator = new Operator();
            $operator->id_user = $user;
            $operators = Operator::where('nama_operator', '=', $request->input('nama_operator'))->first();
            // if ($operators === null) {
            //     $operator->nama_operator = $request->nama_operator;
            // } else {
            // // User exits
            // Alert::warning('Gagal!', 'nama operator tidak boleh sama');
            // return redirect()->back();
            // }
            $operator->nama_operator = $request->nama_operator;
            $operator->stock = $request->stock;
            $operator->harga = $request->harga;
            $operator->save();
            Alert::success('Berhasil!', 'menambah data operator');
            return redirect()->back();
        } catch (Exception $e) {
            Alert::warning('Gagal!', 'menambah data operator');
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
            $user = auth()->user()->id;
            $operator = Operator::find($id);
            $operator->id_user = $user;
            $operator->nama_operator = $request->nama_operator;
            $operator->stock = $request->stock;
            $operator->harga = $request->harga;
            $operator->save();
            Alert::success('Berhasil!', 'menambah data operator');
            return redirect()->back();
        } catch (Exception $e) {
            Alert::warning('Gagal!', 'menambah data operator');
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
            Operator::where('id', $id)->delete();
            Alert::success('Berhasil!', 'menghapus data operator');
            return redirect()->back();
        } catch (Exception $e) {
            Alert::warning('Gagal!', 'menghapus data operator');
            return redirect()->back();
        }
    }


    public function actionoperator($action, $id)
    {
        // $harga = Harga::all();
        $operator =  Operator::where('id', $id)->first();
        if (count($operator->get()) > 0) {
            if ($action == "hapus") {
                $returnHTML = view('layouts.admin.operator.hapus', ['data' => $operator])->render();
                return response()->json(['html' => $returnHTML]);
            } elseif ($action == "edit") {
                $returnHTML = view('layouts.admin.operator.edit', ['data' => $operator])->render();
                return response()->json(['html' => $returnHTML]);
            }
        } else {
            Alert::warning('Gagal!', 'Gagal menampilkan data operator');
            return redirect()->back();
        }
    }
}
