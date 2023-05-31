<?php

namespace App\Http\Controllers\barang;

use App\Models\barang;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function AddItem(Request $request)
    {
        try {
            $data = $request->validate([
                'nama' => 'required|string',
                'jenis' => 'required|string',
                'harga' => 'required|integer',
                'jumlah' => 'required|integer',
            ]);
            
            $authUser = Auth::user();
            if (in_array($authUser->jabatan, ['admin', 'manajer', 'kepala divisi'])) {
                $item = Item::create($data);
                $item->status = 'belum dipersiapkan';
                $item->save();
    
                return response()->json([
                    'message' => 'Berhasil tambah barang',
                    'data' => $item,
                ]);
            } else {
                return response()->json([
                    'message' => 'Jabatan terlalu rendah',
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Gagal Tambah barang',
                'error' => $th->getMessage(),
            ], 500);
        }
    }
    
    public function persiapanBarang()
{
    // Mendapatkan daftar barang yang akan dipersiapkan
    $daftarBarang = Item::where('status', 'belum dipersiapkan')->get();

    // Melakukan persiapan barang
    foreach ($daftarBarang as $barang) {
        // Proses persiapan barang
        // ...
        // Set status barang menjadi "sudah dipersiapkan"
        $barang->status = 'sudah dipersiapkan';
        $barang->save();
    }

    // Mengembalikan pesan sukses
    return 'Persiapan barang berhasil dilakukan';
}

}
