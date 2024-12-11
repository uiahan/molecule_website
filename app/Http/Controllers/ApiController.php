<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use App\Models\Logo;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Exception;
use Illuminate\Validation\ValidationException;


class ApiController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'status' => 'success',
                'message' => 'Login berhasil',
                'token' => $token,
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Email atau password salah',
        ], 401);
    }

    public function updateScanStatus(Request $request)
    {
        // Validasi input
        $request->validate([
            'kode' => 'required|string',
            'telah_scan' => 'required|in:Belum Scan,Sudah Scan',
        ]);

        // Cek apakah user sudah terautentikasi
        $user = $request->user(); // Mendapatkan user yang sedang login melalui token Sanctum

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401); // Jika user tidak terautentikasi
        }

        // Cari data registrasi berdasarkan 'kode'
        $registration = Registration::where('kode', $request->kode)->first();

        if (!$registration) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        // Update status scan
        $registration->telah_scan = $request->telah_scan;

        // Simpan perubahan
        if ($registration->save()) {
            return response()->json(['message' => 'Status scan berhasil diperbarui'], 200);
        }

        return response()->json(['message' => 'Gagal memperbarui status scan'], 500);
    }

    public function show($qrCode)
    {
        // Cari data registrasi berdasarkan QR code
        $qrCode = str_replace('Invitation Code: ', '', $qrCode);

        // Cari data registrasi berdasarkan QR code
        $registration = Registration::where('kode', $qrCode)->first();

        // Jika data tidak ditemukan, kembalikan respon error
        if (!$registration) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $registration->telah_scan = 'Sudah Scan';
        $registration->save(); // Simpan perubahan ke database
        // Jika data ditemukan, kembalikan data dalam format JSON
        return response()->json($registration);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout berhasil'
        ], 200);
    }

    public function checkToken(Request $request)
    {
        // Mendapatkan user dari token yang diberikan
        $user = $request->user();

        if ($user) {
            // Jika token valid dan user ditemukan, kembalikan response dengan status 200
            return response()->json(['message' => 'Token valid'], 200);
        } else {
            // Jika token tidak valid, kembalikan response error
            return response()->json(['message' => 'Token tidak valid'], 401);
        }
    }

    public function getLogo()
    {
        // Ambil logo pertama yang ada
        $logo = Logo::first();

        if ($logo) {
            return response()->json([
                'img' => $logo->img,  // Mengembalikan nama gambar
            ]);
        }

        return response()->json(['message' => 'Logo not found'], 404);
    }
}
