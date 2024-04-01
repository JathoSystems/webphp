<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Advertentie;
use App\Models\Review;
use Illuminate\Support\Facades\Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use League\Csv\Reader; //-- Gebruikt voor CSV uit te lezen


class AdvertentieController extends Controller
{

    private $amountItemsPerPage = 5;

    public function index() // Simpele lijst van advertenties
    {
        // both the advertenties and verhuur_advertenties 
        $favorieten = false;
        $own_ads = false;

        return view('advertentie.index', [
            'advertenties' => Advertentie::paginate($this->amountItemsPerPage),
            'favorieten' => $favorieten,
            'own_ads' => $own_ads,
        ]);
    }

    public function show($id) // Details van een advertentie
    {
        $advertentie = Advertentie::findOrFail($id);
        $reviews = Review::where('advertentie_id', $id)->get();
        
        $related_advertentie_ids = $advertentie->related_advertenties->pluck('related_advertentie_id');
        
        $related_advertenties = Advertentie::whereIn('id', $related_advertentie_ids)->get();

        return view('advertentie.show', [
            'advertentie' => $advertentie,
            'reviews' => $reviews,
            'related_advertenties' => $related_advertenties,
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

        $advertenties = auth()->user()->favoriete_advertenties()
            ->paginate($this->amountItemsPerPage);
            
        $favorieten = true;
        $own_ads = false;

        return view('advertentie.index', [
            'advertenties' => $advertenties,
            'favorieten' => $favorieten,
            'own_ads' => $own_ads,
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


        $uploadedFile = $request->file('csv_file');
        $reader = Reader::createFromPath($uploadedFile->getPathname(), 'r');
        $reader->setDelimiter("\t"); // Stel de juiste scheidingsteken in
        $reader->setHeaderOffset(0);
        $records = $reader->getRecords();

        foreach ($records as $record) {
            $values = explode(';', $record["Titel;Omschrijving;Prijs;Einddatum"]);
            $date = \DateTime::createFromFormat('d-m-Y', $values[3]);
            $formatted_date = $date->format('Y-m-d H:i:s');

            $price = str_replace(',', '.', $values[2]);

            $advertentie_obj = new Advertentie(); 
            $advertentie_obj->title = $values[0];
            $advertentie_obj->description = $values[1];
            $advertentie_obj->price = $price;
            $advertentie_obj->expiration_date = $formatted_date;
            $advertentie_obj->status = "beschikbaar";
            $advertentie_obj->QR_code = "N/A";
            $advertentie_obj->image_url = "N/A";
            
            $advertentie_array = $advertentie_obj->toArray();

            $advertentie = auth()->user()->advertenties()->create($advertentie_array);
        }

        return redirect()->route('advertentie.index');
    }

    public function review($id){
        $advertentie = Advertentie::findOrFail($id); 
        return view('advertentie.review', [
            'advertentie' => $advertentie,
        ]);
    }

    public function addReview(Request $request){

        $advertentie = Advertentie::findOrFail($request->ad_id);

        $newReview = new Review();
        $newReview->user_id = $request->user_id;
        $newReview->advertentie_id = $request->ad_id;
        $newReview->remarks = $request->remarks;
        $newReview->save();
    
        $advertentie->reviews()->save($newReview);
    
        return redirect()->route('advertentie.show', $advertentie->id);
    }

    public function personal(){

        $advertenties = auth()->user()->advertenties()
            ->orderBy('expiration_date', 'asc')    
            ->paginate($this->amountItemsPerPage);

        $favorieten = false;
        $own_ads = true;

        return view('advertentie.index', [
            'advertenties' => $advertenties,
            'favorieten' => $favorieten,
            'own_ads' => $own_ads,
        ]);


    }

}
