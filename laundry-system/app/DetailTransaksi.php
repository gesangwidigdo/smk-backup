<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    protected $table = 'detail_transaksi';
    public $timestamps = false;

    protected $fillable = [
        'id_detail_transaksi', 'id_transaksi', 'id_paket', 'qty', 'subtotal'
    ];
}
