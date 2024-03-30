<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Advertentie;

class HomeController extends Controller
{
    public function index()
    {
        $advertenties = Advertentie::all()->sortByDesc('created_at')->take(4);
        return view('home', [
            'advertenties' => $advertenties,
        ]);
    }
}
