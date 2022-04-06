<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{

    protected $table = 'tb_absensi';

    protected $fillable = [
        'id_absensi', 'timestamp_absensi', 'status_absensi_id', 'tanggal_mulai', 'tanggal_selesai', 'dokumen_pendukung', 'jenis_cuti',
        'lembur', 'keterangan', 'lat', 'lng', 'alamat_absensi', 'created_at', 'updated_at', 'user_id', 'jenis_absensi'
    ];

}
