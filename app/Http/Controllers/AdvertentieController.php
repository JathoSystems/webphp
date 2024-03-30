<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Advertentie;

class AdvertentieController extends Controller
{
    public function index() // Simpele lijst van advertenties
    {
        // both the advertenties and verhuur_advertenties 
        return view('advertentie.index', [
            'advertenties' => Advertentie::all(),
        ]);
    }

    public function show($id) // Details van een advertentie
    {
        $advertentie = Advertentie::findOrFail($id);

        return view('advertentie.show', [
            'advertentie' => $advertentie,
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
            'image' => 'required|file|image|max:2048',
        ]);

        $date = now()->format('YmdHis');

        // change image filename to date and time
        $request->file('image')->storeAs('public/images', $date . '.' . $request->file('image')->extension());

        $request->merge([
            'image_url' => $date . '.' . $request->file('image')->extension(),
        ]);

        $advertentie = auth()->user()->advertenties()->create($request->all());

        return redirect()->route('advertentie.index');
    }

    public function edit($id)
    {
        $advertentie = auth()->user()->advertenties()->findOrFail($id);

        return view('advertentie.edit', [
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
            'image' => 'sometimes|file|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $date = now()->format('YmdHis');

            // change image filename to date and time
            $request->file('image')->storeAs('public/images', $date . '.' . $request->file('image')->extension());

            $request->merge([
                'image_url' => $date . '.' . $request->file('image')->extension(),
            ]);
        }

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
