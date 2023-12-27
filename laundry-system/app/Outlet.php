<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    protected $table = 'outlet';
    public $timestamps = false;
    
    protected $fillable = [
        'nama_outlet', 'alamat'
    ];
}
