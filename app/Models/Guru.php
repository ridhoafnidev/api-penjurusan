<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{

    protected $table = 'tb_guru';

    protected $fillable = [
        'user_id', 'nama', 'username', 'nip', 'alamat', 'email', 'foto','created_at', 'updated_at'
    ];

}
