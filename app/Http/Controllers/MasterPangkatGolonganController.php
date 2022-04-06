<?php

namespace App\Http\Controllers;


use App\Models\MasterPangkatGolongan;

class MasterPangkatGolonganController extends Controller
{

    public function getAll() {
        try {
            $data = MasterPangkatGolongan::all();

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
            $data = MasterPangkatGolongan::where('id_pangkat_golongan', $id)->get();

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
