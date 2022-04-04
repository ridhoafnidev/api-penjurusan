<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Siswa;
use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $level = $request->input('level');
        $password = $request->input('password');
        $username = $request->input('username');

        if ($this->checkUsername($username) == 1) {
            return response()->json([
                'code' => 400,
                'status' => "Failed",
                'message' => 'Username sudah ada!',
                'result' => ''
            ], 400);
        }
        else {
            $user = User::create([
                'username' => $username,
                'password' => Hash::make($password),
                'level' => $level,
            ]);

            if ($user){
                $level = $user->level;

                if ($level == "siswa"){
                    $nisn = $request->input('nisn');
                    $nama = $request->input('nama');
                    $kelas = $request->input('kelas');
                    $tempat_lahir = $request->input('tempat_lahir');
                    $tanggal_lahir = $request->input('tanggal_lahir');
                    $agama = $request->input('agama');
                    $alamat = $request->input('alamat');
                    $asal_sekolah = $request->input('asal_sekolah');
                    $status_asal_sekolah = $request->input('status_asal_sekolah');
                    $nama_ayah = $request->input('nama_ayah');
                    $umur_ayah = $request->input('umur_ayah');
                    $agama_ayah = $request->input('agama_ayah');
                    $pendidikan_terakhir_ayah = $request->input('pendidikan_terakhir_ayah');
                    $pekerjaan_ayah = $request->input('pekerjaan_ayah');
                    $nama_ibu = $request->input('nama_ibu');
                    $umur_ibu = $request->input('umur_ibu');
                    $agama_ibu = $request->input('agama_ibu');
                    $pendidikan_terakhir_ibu = $request->input('pendidikan_terakhir_ibu');
                    $pekerjaan_ibu = $request->input('pekerjaan_ibu');

                    $siswa = Siswa::create([
                        'user_id' => $user->id,
                        'username' => $username,
                        'nisn' => $nisn,
                        'nama' => $nama,
                        'kelas' => $kelas,
                        'tempat_lahir' => $tempat_lahir,
                        'tanggal_lahir' => $tanggal_lahir,
                        'agama' => $agama,
                        'alamat' => $alamat,
                        'asal_sekolah' => $asal_sekolah,
                        'status_asal_sekolah' => $status_asal_sekolah,
                        'nama_ayah' => $nama_ayah,
                        'umur_ayah' => $umur_ayah,
                        'agama_ayah' => $agama_ayah,
                        'pendidikan_terakhir_ayah' => $pendidikan_terakhir_ayah,
                        'pekerjaan_ayah' => $pekerjaan_ayah,
                        'nama_ibu' => $nama_ibu,
                        'umur_ibu' => $umur_ibu,
                        'agama_ibu' => $agama_ibu,
                        'foto' => '',
                        'pendidikan_terakhir_ibu' => $pendidikan_terakhir_ibu,
                        'pekerjaan_ibu' => $pekerjaan_ibu
                    ]);

                    return response()->json([
                        'code' => 200,
                        'status' => "Success",
                        'message' => 'SUCCESS',
                        'result' => $siswa
                    ], 200);

                } elseif ($level == "guru") {
                    $nama = $request->input('nama');
                    $nip = $request->input('nip');
                    $alamat = $request->input('alamat');
                    $email = $request->input('email');

                    $guru = Guru::create([
                        'user_id' => $user->id,
                        'nama' => $nama,
                        'username' => $username,
                        'nip' => $nip,
                        'alamat' => $alamat,
                        'foto' => '',
                        'email' => $email
                    ]);

                    return response()->json([
                        'code' => 200,
                        'status' => "Success",
                        'message' => 'SUCCESS',
                        'result' =>  $guru
                    ], 200);
                }
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
                    ->first(['tb_user.*', 'tb_siswa.nama', 'tb_siswa.id as id_siswa']);
            }
            elseif ($level == "guru") {
                $dataUser = User::join('tb_guru', 'tb_user.username', '=', 'tb_guru.username')
                ->where('tb_user.username', $username)
                ->where('tb_user.level', 'guru')
                ->first(['tb_user.*', 'tb_guru.nama', 'tb_guru.id as id_guru']);
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


    public function getUserDetailById($id_user){
        $user = User::where('id_user', $id_user)->first();

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
                $dataUser = User::join('tb_siswa', 'tb_user.id_user', '=', 'tb_siswa.user_id')
                    ->where('tb_user.id_user', $id_user)
                    ->where('tb_user.level', 'siswa')
                    ->first(['tb_user.*', 'tb_siswa.username', 'tb_siswa.nisn', 'tb_siswa.nama', 'tb_siswa.kelas',
                      'tb_siswa.tanggal_lahir', 'tb_siswa.agama', 'tb_siswa.alamat', 'tb_siswa.foto', 'tb_siswa.asal_sekolah',
                      'tb_siswa.status_asal_sekolah', 'tb_siswa.nama_ayah', 'tb_siswa.umur_ayah', 'tb_siswa.agama_ayah', 'tb_siswa.pendidikan_terakhir_ayah',
                      'tb_siswa.pekerjaan_ayah', 'tb_siswa.nama_ibu', 'tb_siswa.umur_ibu', 'tb_siswa.agama_ibu', 'tb_siswa.pendidikan_terakhir_ibu','tb_siswa.pekerjaan_ibu',
                      'tb_siswa.tempat_lahir', 'tb_siswa.created_at','tb_siswa.updated_at']);
            } elseif ($level == "guru") {
                $dataUser = User::join('tb_guru', 'tb_user.id_user', '=', 'tb_guru.user_id')
                    ->where('tb_user.id_user', $id_user)
                    ->where('tb_user.level', 'guru')
                    ->first(['tb_user.*', 'tb_guru.nama', 'tb_guru.username',
                     'tb_guru.alamat', 'tb_guru.nip','tb_guru.foto', 'tb_guru.email', 'tb_guru.created_at', 'tb_guru.updated_at']);
            }

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

    public function uploadFoto(Request $request, $id_user){
        $user = User::where('id_user', $id_user)->first();

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

            if($level == "siswa"){
                $siswa = User::join('tb_siswa', 'tb_user.id_user', '=', 'tb_siswa.user_id')
                    ->where('tb_user.id_user', $id_user)
                    ->where('tb_user.level', 'siswa')
                    ->first(['tb_user.*', 'tb_siswa.*']);


                    if($request->hasFile('foto')){
                        $foto = $request->file('foto');
                    } else {
                        return response()->json([
                            'code' => 404,
                            'status' => "Failed",
                            'message' => 'Image not found',
                            'result' => ''
                        ], 404);
                    }

                $foto_name = $siswa->nisn.'_'.$foto->getClientOriginalName();

                $updateSiswa = Siswa::whereId($siswa->id)->update([
                    'foto'     => $foto_name
                ]);

                $foto->move(public_path('foto-siswa'), $foto_name);

                if (!$updateSiswa){
                    return response()->json([
                        'code' => 400,
                        'status' => "Failed",
                        'message' => 'Gagal',
                        'result' => ''
                    ], 400);
                } else {
                    $dataUser = User::join('tb_siswa', 'tb_user.id_user', '=', 'tb_siswa.user_id')
                    ->where('tb_user.id_user', $id_user)
                    ->where('tb_user.level', 'siswa')
                    ->first(['tb_user.*', 'tb_siswa.username', 'tb_siswa.nisn', 'tb_siswa.nama', 'tb_siswa.kelas',
                      'tb_siswa.tanggal_lahir', 'tb_siswa.agama', 'tb_siswa.alamat', 'tb_siswa.foto', 'tb_siswa.asal_sekolah',
                      'tb_siswa.status_asal_sekolah', 'tb_siswa.nama_ayah', 'tb_siswa.umur_ayah', 'tb_siswa.agama_ayah', 'tb_siswa.pendidikan_terakhir_ayah',
                      'tb_siswa.pekerjaan_ayah', 'tb_siswa.nama_ibu', 'tb_siswa.umur_ibu', 'tb_siswa.agama_ibu', 'tb_siswa.pendidikan_terakhir_ibu', 'tb_siswa.pekerjaan_ibu',
                      'tb_siswa.tempat_lahir', 'tb_siswa.created_at','tb_siswa.updated_at']);

                    return response()->json([
                        'code' => 200,
                        'status' => "Success",
                        'message' => 'Success',
                        'result' => $dataUser
                    ], 200);
                }
            } else{
                $guru = User::join('tb_guru', 'tb_user.id_user', '=', 'tb_guru.user_id')
                    ->where('tb_user.id_user', $id_user)
                    ->where('tb_user.level', 'guru')
                    ->first(['tb_user.*', 'tb_guru.*']);

                if($request->hasFile('foto')){
                    $foto = $request->file('foto');
                } else {
                    return response()->json([
                        'code' => 404,
                        'status' => "Failed",
                        'message' => 'Image not found',
                        'result' => ''
                    ], 404);
                }

                $foto_name = $guru->nip.'_'.$foto->getClientOriginalName();

                $updateGuru = Guru::whereId($guru->id)->update([
                    'foto'     => $foto_name
                ]);

                $foto->move(public_path('foto-guru'), $foto_name);

                if (!$updateGuru){
                    return response()->json([
                        'code' => 400,
                        'status' => "Failed",
                        'message' => 'Gagal',
                        'result' => ''
                    ], 400);
                } else {
                    $dataUser = User::join('tb_guru', 'tb_user.id_user', '=', 'tb_guru.user_id')
                    ->where('tb_user.id_user', $id_user)
                    ->where('tb_user.level', 'guru')
                    ->first(['tb_user.*', 'tb_guru.nama', 'tb_guru.username',
                     'tb_guru.alamat', 'tb_guru.nip','tb_guru.foto', 'tb_guru.email', 'tb_guru.created_at', 'tb_guru.updated_at']);


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
}
