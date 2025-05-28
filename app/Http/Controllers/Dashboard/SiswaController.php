<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;


class SiswaController extends Controller
{
    public function index()
    {
        return Inertia::render('SiswaPage');
    }
}
