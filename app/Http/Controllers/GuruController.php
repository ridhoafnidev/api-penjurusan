<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller
{

    public function getGuruAll() {
        try {
            $guru = Guru::all();

            return response()->json([
                'code' => 200,
                'status' => "Success",
                'message' => 'SUCCESS',
                'result' => $guru
            ], 200);
        }
        catch (\Exception $exception) {
            return response()->json([
                'code' => 500,
                'status' => "Fail",
                'message' => 'FAILED',
                'result' => $exception->getMessage()
            ], 500);
        }
    }

}
