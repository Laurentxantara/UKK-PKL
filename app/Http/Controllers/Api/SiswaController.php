<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siswa;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        // Menampilkan semua siswal
        $allsiswa = Siswa::all()->map(function($siswa) {
            return [
            'id' => $siswa->id,
            'nama' => $siswa->nama,
            'nis' => $siswa->nis,
            'email' => $siswa->email,
            'gender' => $siswa->gender,
            'status_pkl' => $siswa->status_pkl,
            'avatar' => $siswa->avatar ? asset('storage/' . $siswa->avatar) : null
            ];
        });

        // Menampilkan siswa yang memiliki email sama dengan user
        $siswa = Siswa::where('email', $user->email)->get()->map(function($siswa) {
            return [
            'id' => $siswa->id,
            'nama' => $siswa->nama,
            'nis' => $siswa->nis,
            'email' => $siswa->email,
            'gender' => $siswa->gender,
            'status_pkl' => $siswa->status_pkl,
            'avatar' => $siswa->avatar ? asset('storage/' . $siswa->avatar) : null
            ];
        });
            return response()->json([
                    'allsiswa' => $allsiswa,
                    'siswa' => $siswa
        ]);    
}
}
