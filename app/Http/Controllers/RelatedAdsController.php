<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Advertentie;

class RelatedAdsController extends Controller
{
    public function create($id)
    {
        $advertentie = Advertentie::find($id);
        $advertenties = Advertentie::all();
        // Get only the advertenties that are not related to the current advertentie, and are from the same user
        $advertenties = $advertenties->filter(function ($advertentie) {
            return $advertentie->user_id == auth()->user()->id;
        })->diff($advertentie->related_advertenties);
        // Remove the current advertentie from the list
        $advertenties = $advertenties->filter(function ($advertentie) use ($id) {
            return $advertentie->id != $id;
        });
        return view('advertentie.create-related-ad', [
            'advertentie' => $advertentie,
            'advertenties' => $advertenties,
        ]);
    }

    public function store(Request $request)
    {
        $advertentie = Advertentie::find($request->advertentie_id);
        $advertentie->related_advertenties()->create([
            'related_advertentie_id' => $request->related_advertentie_id,
        ]);
        return redirect()->route('advertentie.show', $advertentie->id);
    }

    public function destroy($id, $related_advertentie_id)
    {
        $advertentie = Advertentie::find($id);
        $related_advertentie = Advertentie::find($related_advertentie_id);
        $advertentie->related_advertenties()->detach($related_advertentie);
        return redirect()->route('advertentie.show', $advertentie->id);
    }
}
