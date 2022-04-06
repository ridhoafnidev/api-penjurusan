<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterJabatanFungsional extends Model
{

    protected $table = 'tb_master_jabatan_fungsional';

    protected $fillable = [
        'id_jabatan_fungsional', 'jabatan_fungsional'
    ];

}
