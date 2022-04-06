<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterStatusAbsensi extends Model
{

    protected $table = 'tb_master_status_absensi';

    protected $fillable = [
        'id_status_absensi', 'status_absensi'
    ];

}
