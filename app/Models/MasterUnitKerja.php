<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterUnitKerja extends Model
{

    protected $table = 'tb_master_unit_kerja';

    protected $fillable = [
        'id_master_unit_kerja', 'unit_kerja'
    ];

}
