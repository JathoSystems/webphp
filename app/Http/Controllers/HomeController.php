<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Advertentie;
use App;

class HomeController extends Controller
{
    public function index()
    {
        $advertenties = Advertentie::all()->sortByDesc('created_at')->take(4);
        return view('home', [
            'advertenties' => $advertenties,
        ]);
    }

    public function setLocale(Request $request, $locale)
    {
        App::setLocale($locale);
        
        $request->session()->put('locale', $locale);

        return redirect()->back();
    }
}
