<?php

namespace App\Http\Controllers;

use App\Models\Jawaban;
use App\Models\Pertanyaan;

class PertanyaanController extends Controller
{
    public function getPertanyaanAll() {
        try {
            $pertanyaans = Pertanyaan::all();
            $data = array();

            foreach ($pertanyaans as $pertanyaan){
                $arrayPertanyaan['id_pertanyaan'] = $pertanyaan->id_pertanyaan;
                $arrayPertanyaan['pertanyaan'] = $pertanyaan->pertanyaan;
                $arrayPertanyaan['jawaban'] = $this->getJawabanByPertanyaanId($pertanyaan->id_pertanyaan);
                array_push($data, $arrayPertanyaan);
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

    private function getJawabanByPertanyaanId($id_pertanyaan)
    {
        return Jawaban::where('pertanyaan_id', $id_pertanyaan)->get();
    }
}
