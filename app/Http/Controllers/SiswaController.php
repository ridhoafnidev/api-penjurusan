<?php

namespace App\Http\Controllers;


use App\Models\Siswa;
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
            $siswa = Siswa::where('user_id', $user_id)->get();

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

}
