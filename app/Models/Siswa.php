<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{

    protected $table = 'tb_siswa';

    protected $fillable = [
        'user_id','username','nisn', 'password', 'nama', 'kelas', 'tanggal_lahir', 'agama', 'alamat', 
        'asal_sekolah', 'status_asal_sekolah', 'nama_ayah','umur_ayah', 'agama_ayah', 
        'pendidikan_terakhir_ayah', 'pekerjaan_ayah', 'nama_ibu', 'umur_ibu', 'agama_ibu', 
        'pendidikan_terakhir_ibu', 'pekerjaan_ibu','foto', 'tempat_lahir','created_at', 'updated_at'
    ];
}
