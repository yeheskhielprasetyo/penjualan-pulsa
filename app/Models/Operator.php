<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operator extends Model
{
    use HasFactory;

    protected $fillable = ['id_user', 'nama_operator', 'stock', 'harga'];

    protected $table = 'operators';

    // public function harga()
    // {
    //     return $this->belongsTo(Harga::class, 'id_harga');
    // }

    public function operator()
    {
        return $this->hasMany(Laporan::class, 'id_operator');
    }
}
