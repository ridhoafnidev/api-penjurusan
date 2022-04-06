<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterPnsNonPns extends Model
{

    protected $table = 'tb_master_pns_nonpns';

    protected $fillable = [
        'id_master_pns_nonpns', 'pns_nonpns'
    ];

}
