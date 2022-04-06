<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{

    protected $table = 'tb_pegawai';

    protected $fillable = [
        'id_pegawai', 'nik', 'nip', 'nama_lengkap', 'email', 'no_hp', 'pns_nonpns_id', 'jenis_tenaga_id', 'unit_kerja_id', 'jabatan_struktural_id', 'jabatan_fungsional_id',
        'pangkat_golongan_id', 'is_active'
    ];

}
