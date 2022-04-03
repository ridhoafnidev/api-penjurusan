<?php

namespace App\Http\Controllers;


use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{

    public function getSiswaAll() {
        try {
            $siswa = Siswa::all();

            return response()->json([
                'code' => 200,
                'status' => "Success",
                'message' => 'SUCCESS',
                'result' => $siswa
            ]);
        }
        catch (\Exception $exception) {
            return response()->json([
                'code' => 500,
                'status' => "Failed",
                'message' => 'FAILED',
                'result' => $exception->getMessage()
            ], 500);
        }
    }

    public function getSiswaAllByUserId($id) {
        try {
            $siswa = Siswa::where('user_id', $id)->get();

            return response()->json([
                'code' => 200,
                'status' => "Success",
                'message' => 'SUCCESS',
                'result' => $siswa
            ]);
        }
        catch (\Exception $exception) {
            return response()->json([
                'code' => 500,
                'status' => "Failed",
                'message' => 'FAILED',
                'result' => $exception->getMessage()
            ], 500);
        }
    }

    public function updateSiswa(Request $request, $id_user){
        $user = User::where('id_user', $id_user)->first();

        $nama = $request->input('nama');
        $nisn = $request->input('nisn');
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

        $updateSiswa = Siswa::whereUserId($id_user)->update([
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
            'pendidikan_terakhir_ibu' => $pendidikan_terakhir_ibu,
            'pekerjaan_ibu' => $pekerjaan_ibu
        ]);

        if (!$updateSiswa){
            return response()->json([
                'code' => 404,
                'status' => "Failed",
                'message' => 'Gagal, User
                 tidak ditemukan!',
                'result' => ''
            ], 404);
        } else {
            $dataUser = User::join('tb_siswa', 'tb_user.id_user', '=', 'tb_siswa.user_id')
                    ->where('tb_user.id_user', $id_user)
                    ->where('tb_user.level', 'siswa')
                    ->first(['tb_user.*', 'tb_siswa.username', 'tb_siswa.nisn', 'tb_siswa.nama', 'tb_siswa.kelas',
                      'tb_siswa.tanggal_lahir', 'tb_siswa.agama', 'tb_siswa.alamat', 'tb_siswa.foto', 'tb_siswa.asal_sekolah',
                      'tb_siswa.status_asal_sekolah', 'tb_siswa.nama_ayah', 'tb_siswa.umur_ayah', 'tb_siswa.agama_ayah', 'tb_siswa.pendidikan_terakhir_ayah',
                      'tb_siswa.pekerjaan_ayah', 'tb_siswa.nama_ibu', 'tb_siswa.umur_ibu', 'tb_siswa.agama_ibu', 'tb_siswa.pendidikan_terakhir_ibu', 'tb_siswa.pekerjaan_ibu',
                      'tb_siswa.tempat_lahir', 'tb_siswa.created_at','tb_siswa.updated_at']);

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
