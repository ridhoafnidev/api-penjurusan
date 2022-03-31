<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller
{

    public function getGuruAll() {
        try {
            $guru = Guru::all();

            return response()->json([
                'code' => 200,
                'status' => "Success",
                'message' => 'SUCCESS',
                'result' => $guru
            ], 200);
        }
        catch (\Exception $exception) {
            return response()->json([
                'code' => 500,
                'status' => "Fail",
                'message' => 'FAILED',
                'result' => $exception->getMessage()
            ], 500);
        }
    }

    public function updateGuru(Request $request, $id_user){
        $user = User::where('id_user', $id_user)->first();

        $nama = $request->input('nama');
        $nip = $request->input('nip');
        $alamat = $request->input('alamat');
        $email = $request->input('email');

        $updateGuru = Guru::whereUserId($id_user)->update([
            'nip' => $nip,
            'nama' => $nama,
            'alamat' => $alamat,
            'email' => $email
        ]);

        if (!$updateGuru){
            return response()->json([
                'code' => 404,
                'status' => "Failed",
                'message' => 'Gagal, User
                 tidak ditemukan!',
                'result' => ''
            ], 404);
        } else {
            $dataUser = User::join('tb_guru', 'tb_user.id_user', '=', 'tb_guru.user_id')
            ->where('tb_user.id_user', $id_user)
            ->where('tb_user.level', 'guru')
            ->first(['tb_user.*', 'tb_guru.nama', 'tb_guru.username',
             'tb_guru.alamat', 'tb_guru.nip','tb_guru.foto', 'tb_guru.email', 'tb_guru.created_at', 'tb_guru.updated_at']);
    
             if (!$dataUser){
                return response()->json([
                    'code' => 404,
                    'status' => "Failed",
                    'message' => 'Gagal, User
                     tidak ditemukan!',
                    'result' => ''
                ], 404);
            } else {
                return response()->json([
                    'code' => 200,
                    'status' => "Success",
                    'message' => 'Success',
                    'result' => $dataUser
                ], 200);
            }
        }
    }
}
