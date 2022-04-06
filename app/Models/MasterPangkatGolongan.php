<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterPangkatGolongan extends Model
{

    protected $table = 'tb_master_pangkat_golongan';

    protected $fillable = [
        'id_pangkat_golongan', 'pangkat_golongan'
    ];

}
