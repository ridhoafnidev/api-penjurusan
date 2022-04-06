<?php

namespace App\Http\Controllers;

use App\Models\NilaiSiswa;
use App\Models\Siswa;
use App\Models\User;
use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NilaiSiswaController extends Controller
{

    public function insertNilaiSiswa(Request $request){

        $id_user = $request->input('id_user');
        $rata_raport_ipa = $request->input('rata_raport_ipa');
        $rata_raport_ips = $request->input('rata_raport_ips');

        $rata_akhir = ($rata_raport_ipa + $rata_raport_ips) / 2;

        $check_data = NilaiSiswa::where('user_id', $id_user)->first();

        if($check_data){
            return response()->json([
                'code' => 400,
                'status' => "Failed",
                'message' => 'Data sudah ada sebelumnya',
                'result' => ''
            ], 400);
        } else {
            $nilai_siswa = NilaiSiswa::create([
                'user_id' => $id_user,
                'rata_raport_ipa' => $rata_raport_ipa,
                'rata_raport_ips' => $rata_raport_ips,
                'rata_akhir' => $rata_akhir,
            ]);

            if (!$nilai_siswa){
                return response()->json([
                    'code' => 400,
                    'status' => "Failed",
                    'message' => 'Gagal menambahkan data',
                    'result' => ''
                ], 400);
            }
    
            $hasil = NilaiSiswa::where('user_id', $id_user)->first(
                ['tb_nilai_siswa.id', 'tb_nilai_siswa.user_id',
                         'tb_nilai_siswa.rata_raport_ipa', 'tb_nilai_siswa.rata_raport_ips'
                         ,'tb_nilai_siswa.rata_akhir']
            );
    
            return response()->json([
                'code' => 200,
                'status' => "Success",
                'message' => 'Success',
                'result' => $hasil
            ], 200);
        }

        

    }

    public function updateNilaiSiswa(Request $request, $id_user){

        $rata_raport_ipa = $request->input('rata_raport_ipa');
        $rata_raport_ips = $request->input('rata_raport_ips');

        $rata_akhir = ($rata_raport_ipa + $rata_raport_ips) / 2;

        $check_data = NilaiSiswa::where('user_id', $id_user)->first();

        if(!$check_data){
            return response()->json([
                'code' => 400,
                'status' => "Failed",
                'message' => 'Data tidak ditemukan',
                'result' => ''
            ], 400);
        } else {
            $nilai_siswa = NilaiSiswa::whereUserId($id_user)->update([
                'rata_raport_ipa' => $rata_raport_ipa,
                'rata_raport_ips' => $rata_raport_ips,
                'rata_akhir' => $rata_akhir,
            ]);
    
            if (!$nilai_siswa){
                return response()->json([
                    'code' => 400,
                    'status' => "Failed",
                    'message' => 'Gagal memperbarui data',
                    'result' => ''
                ], 400);
            }
    
            $hasil = NilaiSiswa::where('user_id', $id_user)->first(
                ['tb_nilai_siswa.id', 'tb_nilai_siswa.user_id',
                         'tb_nilai_siswa.rata_raport_ipa', 'tb_nilai_siswa.rata_raport_ips'
                         ,'tb_nilai_siswa.rata_akhir']
            );
    
            return response()->json([
                'code' => 200,
                'status' => "Success",
                'message' => 'Success',
                'result' => $hasil
            ], 200);
        }
    }

    public function getNilaiSiswaById($id_user) {
        $nilai_siswa = NilaiSiswa::where('user_id', $id_user)->first(
            ['tb_nilai_siswa.id', 'tb_nilai_siswa.user_id',
                     'tb_nilai_siswa.rata_raport_ipa', 'tb_nilai_siswa.rata_raport_ips'
                     ,'tb_nilai_siswa.rata_akhir']
        );

        if (!$nilai_siswa){
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
                'result' => $nilai_siswa
            ], 200);
        }
    }

    public function getNilaiSiswaAll() {
        try {
            $nilai_siswa = NilaiSiswa::all();

            $data = array();

            foreach ($nilai_siswa as $item){
                $array['id'] = $item->id;
                $array['user_id'] = $item->user_id;
                $array['rata_raport_ipa'] = $item->rata_raport_ipa;
                $array['rata_raport_ips'] = $item->rata_raport_ips;
                $array['rata_akhir'] = $item->rata_akhir;
                array_push($data, $array);
            }

            return response()->json([
                'code' => 200,
                'status' => "Success",
                'message' => "SUCCESS",
                'result' => $data
            ], 200);
        }
        catch (\Exception $exception) {
            return response()->json([
                'code' => 500,
                'status' => "Success",
                'message' => "SUCCESS",
                'result' => $exception->getMessage()
            ], 500);

        }

    }

    public function deleteNilaiSiswa($id_user)
    {
        $nilai_siswa = NilaiSiswa::whereUserId($id_user)->first();
            
        $nilai_siswa->delete();

        if ($nilai_siswa) {
            return response()->json([
                'success' => true,
                'message' => 'Data Berhasil Dihapus!',
            ], 200);
        } else {
            return response()->json([
                'code' => 404,
                'status' => "Failed",
                'message' => 'Gagal menghapus data',
                'result' => ''
            ], 404);
        }

    }
}
