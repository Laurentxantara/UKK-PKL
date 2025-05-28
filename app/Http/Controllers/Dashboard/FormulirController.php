<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class FormulirController extends Controller
{
public function index()
{
    return Inertia::render('FormulirPage',);
}

}
