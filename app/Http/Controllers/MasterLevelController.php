<?php

namespace App\Http\Controllers;


use App\Models\MasterLevel;

class MasterLevelController extends Controller
{

    public function getMasterLevelAll() {
        try {
            $data = MasterLevel::all();

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

    public function getMasterLevelById($id) {
        try {
            $data = MasterLevel::where('id_level', $id)->get();

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
