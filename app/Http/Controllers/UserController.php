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

        if (!$user){
            return response()->json([
                'code' => 200,
                'status' => "Failed",
                'message' => 'FAILED, User tidak ditemukan!',
                'result' => ''
            ], 500);
        }

        $isValidPassword = Hash::check($password, $user->password);

        if (!$isValidPassword){
            return response()->json([
                'code' => 200,
                'status' => "Failed",
                'message' => 'FAILED, Username atau password salah!',
                'result' => ''
            ], 500);
        }

        return response()->json([
            'code' => 200,
            'status' => "Success",
            'message' => 'SUCCESS',
            'result' => $dataUser
        ], 200);

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

}
