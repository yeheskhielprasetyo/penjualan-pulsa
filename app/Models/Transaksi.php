<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'id_operator', 'id_barang', 'jumlah', 'jumlah_aksesoris', 'no_hp', 'total_harga', 'status'];

    protected $table = 'transaksis';


    public function operator()
    {
        return $this->belongsTo(Operator::class, 'id_operator', 'id');
    }

    public function barang()
    {
        return $this->belongsTo(DataBarang::class, 'id_barang', 'id');
    }

    public function transaksi()
    {
        return $this->hasMany(DataTransaksi::class, 'id_transaksi', 'id');
    }
}
