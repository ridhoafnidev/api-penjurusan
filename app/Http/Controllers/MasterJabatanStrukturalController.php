<?php

namespace App\Http\Controllers;


use App\Models\MasterJabatanStruktural;

class MasterJabatanStrukturalController extends Controller
{

    public function getAll() {
        try {
            $data = MasterJabatanStruktural::all();

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
            $data = MasterJabatanStruktural::where('id_jabatan_struktural', $id)->get();

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
