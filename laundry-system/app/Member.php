<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'member';
    public $timestamps = false;

    protected $fillable = [
        'nama_member', 'alamat', 'jenis_kelamin', 'no_tlp'
    ];
}
