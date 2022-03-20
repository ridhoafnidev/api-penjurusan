<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    protected $table = 'tb_jawaban';

    protected $fillable = [
        'id_jawaban', 'pertanyaan_id', 'jawaban'
    ];
}
