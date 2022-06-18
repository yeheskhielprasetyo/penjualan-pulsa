<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksiAksesoris extends Model
{
    use HasFactory;

    protected $fillable = ['id_barang', 'banyak', 'total'];

    protected $table = 'detail_transaksi_aksesoris';


    public function barang()
    {
        return $this->belongsTo(DataBarang::class, 'id_barang');
    }

    public function transaksi_aksesoris()
    {
        return $this->hasMany(Transaksi::class, 'id');
    }

}
