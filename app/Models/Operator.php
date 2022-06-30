<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operator extends Model
{
    use HasFactory;

    protected $fillable = ['id_user', 'nama_operator', 'stock', 'harga'];

    protected $table = 'operators';

    public function operator()
    {
        return $this->hasMany(Transaksi::class, 'id_operator', 'id');
    }
}
