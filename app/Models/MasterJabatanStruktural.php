<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterJabatanStruktural extends Model
{

    protected $table = 'tb_master_jabatan_struktural';

    protected $fillable = [
        'id_master_jabatan_struktural', 'jabatan_struktural'
    ];

}
