<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{

    protected $table = 'tb_guru';

    protected $fillable = [
        'id', 'user_id', 'nama', 'username', 'password', 'alamat', 'email', 'created_at', 'updated_at'
    ];

}
