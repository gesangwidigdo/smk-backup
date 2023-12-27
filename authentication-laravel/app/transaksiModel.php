<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class transaksiModel extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id_barang', 'id_pembeli'
    ];
}
