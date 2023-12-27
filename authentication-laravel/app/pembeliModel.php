<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pembeliModel extends Model
{
    protected $table = 'pembeli';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'nama_pembeli', 'jk_pembeli',
        'no_telp', 'alamat'
    ];
}
