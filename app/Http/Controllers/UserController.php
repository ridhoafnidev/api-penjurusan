<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|unique:tb_user',
            'password' => 'required|min:6'
        ]);

        $username = $request->input('username');
        $password = Hash::make($request->input('password'));

        if ($this->checkUsername($username) == 1) {
            return response()->json([
                'code' => 200,
                'status' => "Failed",
                'message' => 'Username sudah ada!',
                'result' => ''
            ], 500);
        }
        else {
            $user = User::create([
                'username' => $username,
                'password' => $password
            ]);

            if ($user){
                return response()->json([
                    'code' => 200,
                    'status' => "Success",
                    'message' => 'SUCCESS',
                    'result' => ''
                ], 200);
            }
            else {
                return response()->json([
                    'code' => 200,
                    'status' => "Failed",
                    'message' => 'FAILED',
                    'result' => ''
                ], 500);
            }
        }
    }

    public function login(Request $request){
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required|min:6'
        ]);

        $username = $request->input('username');
        $password = $request->input('password');

        $user = User::where('username', $username)->first();

        if (!$user){
            return response()->json([
                'code' => 404,
                'status' => "Failed",
                'message' => 'Gagal, User
                 tidak ditemukan!',
                'result' => ''
            ], 404);
        } else {
            $level = $user->level;

            if ($level == "siswa"){
                $dataUser = User::join('tb_siswa', 'tb_user.username', '=', 'tb_siswa.username')
                    ->where('tb_user.username', $username)
                    ->where('tb_user.level', 'siswa')
                    ->first(['tb_user.*', 'tb_siswa.nama']);
            }
            elseif ($level == "guru") { 
                $dataUser = User::join('tb_guru', 'tb_user.username', '=', 'tb_guru.username')
                ->where('tb_user.username', $username)
                ->where('tb_user.level', 'guru')
                ->first(['tb_user.*', 'tb_guru.nama']);
            }

            $isValidPassword = Hash::check($password, $user->password);

            if (!$isValidPassword){
                return response()->json([
                    'code' => 400,
                    'status' => "Failed",
                    'message' => 'Gagal, Username atau password salah!',
                    'result' => ''
                ], 400);
            }

            return response()->json([
                'code' => 200,
                'status' => "Success",
                'message' => 'Success',
                'result' => $dataUser
            ], 200);
        }
    }

    public function checkUsername($username){
        $checkUsername = User::where('username', $username)->count();
        if ($checkUsername > 0){
            return 1;
        }
        else {
            return 0;
        }
    }

    public function changePassword(Request $request, $id_user){
        $this->validate($request, [
            'oldPassword' => 'required',
            'newPassword' => 'required'
        ]);

        $oldPassword = $request->input('oldPassword');
        $newPassword = $request->input('newPassword');

        $user = User::where('id_user', $id_user)->first();
        
        $isValidOldPassword = Hash::check($oldPassword, $user->password);

        if(!$isValidOldPassword){ 
            return response()->json([
                'code' => 400,
                'status' => "Failed",
                'message' => 'Gagal, Kata sandi yang anda masukkan tidak sesuai!',
                'result' => ''
            ], 400);
        } else {

            if(Hash::check($newPassword, $user->password)){
                return response()->json([
                    'code' => 400,
                    'status' => "Failed",
                    'message' => 'Gagal, Kata sandi baru anda masih sama seperti sebelumnya',
                    'result' => ''
                ], 400);
            }

            $user = User::whereIdUser($id_user)->update([
                'password' => Hash::make($request->newPassword)
            ]);

            if ($user){
                return response()->json([
                    'code' => 200,
                    'status' => "Success",
                    'message' => 'Sukses, kata sandi berhasil diubah',
                    'result' => ''
                ], 200);
            }
            else {
                return response()->json([
                    'code' => 400,
                    'status' => "Failed",
                    'message' => 'FAILED',
                    'result' => ''
                ], 400);
            }
        }   
    }

}
