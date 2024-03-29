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

    public function markFavorite(Advertentie $advertentie)
    {
        //-- 1. Kijk of de advertentie al is gemarkeerd als favoriet
        $isFavorite = auth()->user()->favoriete_advertenties()->where('advertentie_id', $advertentie->id)->exists();

        //-- 2. Als de advertentie nog niet gemarkeerd is, markeer hem
        if (!$isFavorite) {
            auth()->user()->favoriete_advertenties()->attach($advertentie);
            return redirect()->back()->with('success', 'Advertentie gemarkeerd als favoriet.');
        }

        //-- 3. Als de advertentie al wel gemarkeerd is, de-markeer hem.
        auth()->user()->favoriete_advertenties()->detach($advertentie);
        return redirect()->back()->with('success', 'Advertentie gedemarkeerd als favoriet.');
        
    } 
}
