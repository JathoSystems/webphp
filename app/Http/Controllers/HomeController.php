<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Advertentie;

class HomeController extends Controller
{
    public function index()
    {
        $advertenties = Advertentie::all();
        return view('home', [
            'advertenties' => $advertenties,
        ]);
    }
}
