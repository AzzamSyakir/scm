<?php

namespace App\Http\Controllers\karyawan;

use App\Models\Karyawan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controller;

class HomeController extends Controller
{
    //register karyawan 
    public function RegisterUser(Request $request)
    {
        try {
            $data = $request->validate([
                'nama' => 'required|string',
                'jabatan' => 'required|string',
                'divisi' => 'required|string',
                'password' => 'required|string',
            ]);
    
            $data['password'] = Hash::make($data['password']);
            $user = Karyawan::create($data);

            return response()->json([
                'message' => 'Berhasil tambah user',
                'data' => $user,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Gagal Tambah user',
                'error' => $th->getMessage(),
            ], 500);
        }
    }
    // login
    public function LoginUser(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|',
            'password' => 'required|string'
        ]);

        $credentials = request(['nama', 'password']);

        $nama = $credentials['nama'];
        $password = $credentials['password'];

        $user = Karyawan::where('nama', $nama)->first();

        if (!$user) {
            return response()->json([
                'message' => 'nama tidak terdaftar'
            ], 401);
        }

        if (!Hash::check($password, $user->password)) {
            return response()->json([
                'message' => 'Password salah'
            ], 401);
        }

        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        
        if (!$tokenResult) {
            return response()->json([
                'message' => 'Gagal membuat token'
            ], 500);
        }
        $token->save();
        
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
        
    }
    
    public function LogoutUser(Request $request){
        $user = $request->user();
        $token = $request->user()->token()->revoke();
        return response()->json([
            'user' => $user,
            'message' => 'Successfully logged out'
        ]);
    }

    
}
