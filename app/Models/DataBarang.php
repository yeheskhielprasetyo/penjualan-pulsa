<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataBarang extends Model
{
    use HasFactory;

    protected $fillable = ['nama_barang', 'harga_barang', 'jenis_barang', 'satuan', 'id_user'];

    protected $table = 'data_barangs';

    public function barang()
    {
        return $this->hasMany(Transaksi::class, 'id_barang', 'id');
    }

}
