<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NilaiSiswa extends Model
{
    protected $table = 'tb_nilai_siswa';

    protected $fillable = [
        'id', 'user_id', 'rata_raport_ipa','rata_raport_ips', 'rata_akhir', 'created_at', 'updated_at'
    ];
}
