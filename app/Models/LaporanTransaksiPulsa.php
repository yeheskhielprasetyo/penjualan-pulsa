<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanTransaksiPulsa extends Model
{
    use HasFactory;

    public function transaksi()
    {
        return $this->belongsTo(transaksi::class, 'id_transaksi');
    }
}
