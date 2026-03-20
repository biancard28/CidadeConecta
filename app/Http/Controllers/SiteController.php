<?php

namespace App\Http\Controllers;

use App\Models\Cidade;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function agenda_municipal(Cidade $cidade)
    {
        return view('agenda_municipal', compact('cidade'));
    }
}
