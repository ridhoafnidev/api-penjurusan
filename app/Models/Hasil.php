<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hasil extends Model
{

    protected $table = "tb_hasil";

    protected $fillable = [
       'id_hasil', 'siswa_id', 'hasil_akhir'
    ];

}
