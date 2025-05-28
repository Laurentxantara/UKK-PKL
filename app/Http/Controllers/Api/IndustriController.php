<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Industri;

class IndustriController extends Controller
{
    public function index()
    {
        $industri = Industri::all()->map(function($industri) {
            return [
                'id' => $industri->id,
                'nama' => $industri->nama,
                'bidang_usaha' => $industri->bidang_usaha,
                'alamat' => $industri->alamat,
                'kontak' => $industri->kontak,
                'email' => $industri->email,
                'website' => $industri->website,
                'logo' => $industri->logo ? asset('storage/' . $industri->logo) : null
            ];
        });
        return response()->json($industri);
    }
}
