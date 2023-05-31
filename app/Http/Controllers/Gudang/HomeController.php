<?php

namespace App\Http\Controllers\Gudang;

use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class HomeController extends Controller
{
    //daftarkan gudang 
    public function DaftarGudang(Request $request){
        try {
            $data = $request->validate([
                'nama' => 'required|string',
                'alamat' => 'required|string',
                'kapasitas' => 'required|string',
            ]);

    
            $user = Warehouse::create($data);

            return response()->json([
                'message' => 'Berhasil mendaftarkan gudang',
                'data' => $user,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Gagal mendaftarkan gudang',
                'error' => $th->getMessage(),
            ], 500);
        }
    }
}
