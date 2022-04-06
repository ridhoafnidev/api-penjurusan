<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterJenisTenaga extends Model
{

    protected $table = 'tb_master_jenis_tenaga';

    protected $fillable = [
        'id_master_jenis_tenaga', 'jenis_tenaga'
    ];

}
