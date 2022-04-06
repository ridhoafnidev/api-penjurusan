<?php

namespace App\Http\Controllers;


use App\Models\Absensi;

class AbsensiController extends Controller
{

    public function getAll() {
        try {
            $data = Absensi::all();

            return response()->json([
                'code' => 200,
                'status' => "Success",
                'message' => 'SUCCESS',
                'result' => $data
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

    public function getById($id) {
        try {
            $data = Absensi::where('id_absensi', $id)->get();

            return response()->json([
                'code' => 200,
                'status' => "Success",
                'message' => 'SUCCESS',
                'result' => $data
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
