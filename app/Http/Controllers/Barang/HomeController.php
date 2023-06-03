<?php

namespace App\Http\Controllers\barang;

use App\Models\barang;
use App\Models\Item;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function AddItem(Request $request)
    {
        try {
            $data = $request->validate([
                'jenis' => 'required|string',
                'nama' => 'required|string',
                'harga' => 'required|integer',
                'jumlah' => 'required|integer',
            ]);
            
            $authUser = Auth::user();
            if (in_array($authUser->jabatan, ['admin', 'manajer', 'kepala divisi'])) {
                $item = Item::create($data);
                $item->status = 'belum di persiapkan';
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
function SimpanBarang(Request $request, $idBarang)
{
    // Ambil barang berdasarkan ID
    $barang = Item::find($idBarang);
    
    // Periksa apakah barang ditemukan
    if ($barang->status = 'sudah dipersiapkan') {
        // Lakukan logika penyimpanan sesuai dengan kebutuhan
        if ($barang->jumlah > 0) {
            // Contoh logika penyimpanan: Simpan barang ke tempat penyimpanan tertentu
            $barang->id_gudang = $request->id_gudang; // Ganti "idgudang" dengan input yang sesuai dari request
            $barang->save();
        } else {
            return response()->json("Jumlah barang tidak mencukupi.");
        }
    } else {
        return response()->json("Barang tidak ditemukan.");
    }
    
    // Kembalikan pesan sukses
    return response()->json("Penyimpanan barang selesai.");
}
function filterambilBarang(Request $request, $idgudang){
    // Mengambil semua barang dengan ID gudang yang sesuai
    $barang = Item::where('id_gudang', $idgudang)->get();

    // Memeriksa apakah ada barang yang ditemukan
    if(!$barang){
        return response()->json("Barang tidak ditemukan.");
    }

    // Mengembalikan respons JSON dengan daftar barang
    return response()->json([
        "Barang" => $barang
    ]);
}

}
