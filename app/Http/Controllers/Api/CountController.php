<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Siswa;

class CountController extends Controller
{
    public function index()
    {
        return response()->json([
            'total_guru' => Guru::count(),
            'total_siswa' => Siswa::count()
        ]);
    }
}