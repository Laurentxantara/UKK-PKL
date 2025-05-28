<?php

namespace App\Http\Controllers\Dashboard;

use Inertia\Inertia;
use App\Models\Guru; 
use App\Http\Controllers\Controller;


class GuruController extends Controller
{
    public function index()
    {
        return Inertia::render('PembimbingPage');
    }
}
