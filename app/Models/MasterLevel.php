<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterLevel extends Model
{

    protected $table = 'tb_master_level';

    protected $fillable = [
        'id_level', 'level', 'is_active'
    ];

}
