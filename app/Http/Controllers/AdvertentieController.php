<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Advertentie;

class AdvertentieController extends Controller
{
    public function index() // Simpele lijst van advertenties
    {
        return view('advertentie.index', [
            'advertenties' => Advertentie::all(),
        ]);
    }

    public function create()
    {
        return view('advertentie.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'expiration_date' => 'required|date',
        ]);

        $advertentie = auth()->user()->advertenties()->create($request->all());

        return redirect()->route('advertentie.index');
    }

    public function edit($id)
    {
        $advertentie = auth()->user()->advertenties()->findOrFail($id);

        return view('advertentie.create', [
            'advertentie' => $advertentie,
        ]);
    }

    public function update(Request $request, $id)
    {
        $advertentie = auth()->user()->advertenties()->findOrFail($id);

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'expiration_date' => 'required|date',
        ]);

        $advertentie->update($request->all());

        return redirect()->route('advertentie.index');
    }

    public function destroy($id)
    {
        $advertentie = auth()->user()->advertenties()->findOrFail($id);

        $advertentie->delete();

        return redirect()->route('advertentie.index');
    }
}
