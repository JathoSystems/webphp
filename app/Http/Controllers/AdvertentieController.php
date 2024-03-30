<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Advertentie;
use Illuminate\Support\Facades\Validator;
use League\Csv\Reader; //-- Gebruikt voor CSV uit te lezen


class AdvertentieController extends Controller
{
    public function index() // Simpele lijst van advertenties
    {
        // both the advertenties and verhuur_advertenties 
        $favorieten = false;

        return view('advertentie.index', [
            'advertenties' => Advertentie::all(),
            'favorieten' => $favorieten,
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

        auth()->user()->favoriete_advertenties()->detach($advertentie);
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

    public function favorieten(){

        $advertenties = auth()->user()->favoriete_advertenties()->get();
        $favorieten = true;

        return view('advertentie.index', [
            'advertenties' => $advertenties,
            'favorieten' => $favorieten,
        ]);
    }


    public function importeren(){

        return view('advertentie.import');
    }

    public function importAdvertenties(Request $request){


        $validator = Validator::make($request->all(), [
            'csv_file' => 'required|file|mimes:csv,txt|max:2048', // max 2MB
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        // Verkrijg het geüploade bestand
        $uploadedFile = $request->file('csv_file');

        // Open het CSV-bestand met behulp van de league/csv Reader
        $reader = Reader::createFromPath($uploadedFile->getPathname(), 'r');
        
        // Stel de koppen in als kolomnamen
        $reader->setHeaderOffset(0);
        
        // Lees alle records in het CSV-bestand
        $records = $reader->getRecords();
        // Loop door alle records en verwerk ze
        foreach ($records as $record) {


            
            $values = explode(';', $record['Titel;Omschrijving;Prijs;Einddatum']);

            $advertentie_obj = new Advertentie(); 
            $advertentie_obj->title = $values[0];
            $advertentie_obj->description = $values[1];
            $advertentie_obj->price = $values[2];
            $advertentie_obj->expiration_date = $values[3];

            $advertentie = auth()->user()->advertenties()->create($advertentie_obj);
            //-- Maak nieuwe advertentie aan.


            // $record is een associatieve array waarbij de sleutels de kolomnamen zijn
            // Verwerk hier elk record, bijvoorbeeld:
            // $record['column_name']
        }


        dd();

    }
}
