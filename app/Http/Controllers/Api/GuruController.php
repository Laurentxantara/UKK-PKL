<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Guru;

class GuruController extends Controller
{
    public function index()
    {
        $guru = Guru::all()->map(function($guru) {
            return [
                'id' => $guru->id,
                'nama' => $guru->nama,
                'email' => $guru->email,
                'nip' => $guru->nip,
                'gender' => $guru->gender,
                'avatar' => $guru->avatar ? asset('storage/' . $guru->avatar) : null
            ];
        });
        return response()->json($guru);
    }
}