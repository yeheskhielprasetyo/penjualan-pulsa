<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'id_operator', 'jumlah', 'no_hp', 'total_harga', 'created_at'];

    protected $table = 'transaksis';

    public $timestamps = false;

    public function operator()
    {
        return $this->belongsTo(Operator::class, 'id_operator');
    }

    public function transaksi_aksesoris()
    {
        return $this->belongsTo(DetailTransaksiAksesoris::class, 'id');
    }

    public function transaksi()
    {
        return $this->hasMany(Pelanggan::class, 'id_transaksi_pulsa');
    }
}
