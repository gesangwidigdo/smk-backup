<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class barangModel extends Model
{
    protected $table = 'barang';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'nama_barang', 'harga', 'stok'
    ];
}
