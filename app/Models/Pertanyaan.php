<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pertanyaan extends Model
{

    protected $table = 'tb_pertanyaan';

    protected $fillable = [
        'id_pertanyaan', 'pertanyaan'
    ];

}
