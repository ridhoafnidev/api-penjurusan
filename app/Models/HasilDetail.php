<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasilDetail extends Model
{

    protected $table = "tb_hasil_detail";

    protected $fillable = [
        'id_hasil_detail', 'hasil_id', 'jawaban_id','created_at', 'updated_at'
    ];

}
