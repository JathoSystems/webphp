<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Ad;
use App\Models\AdBidding;

class BiddingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $biedingenAds = Ad::biedingen()->paginate(2);
        return view('bidding.index')->with('ads', $biedingenAds);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $adId)
    {
        return view('bidding.create')->with('adId', $adId);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $adId = $request->input('adId');
        $validator = Validator::make($request->all(), [
            'price' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $priceString = $request->input('price');
        $price = (double)$priceString;

        // Nu kun je de geconverteerde prijs doorgeven aan de methode
        $highestBid = self::getHighestBid($price, $adId);
        $valid = $price > $highestBid;
        if($valid){
            $bidding = new AdBidding();
            //-- Voeg velden toe uit request om ze op te slaan in DB
            $bidding->price = $request->input('price');
            $bidding->dateTime = date('Y-m-d H:i:s');
            $bidding->user = "Placeholder";
            $bidding->adId = $adId;
    
            $bidding->save();
            
            $ad = Ad::find($adId);
            $adBiddings = AdBidding::where('adId', $adId)->get();
            return redirect()->route('biddings.index');
        } else{
            return redirect()->back()
                ->withErrors("Kan niet lager dan hoogste bod bieden. Hoogste bod: " . $highestBid . ".")
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $adId)
    {
        $ad = Ad::find($adId);
        $adBiddings = AdBidding::where('adId', $adId)->get();
        return view('bidding.view')
            ->with('ad', $ad)
            ->with('adBiddings', $adBiddings);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    private function getHighestBid(float $price, string $adId){
        return AdBidding::where('adId', $adId)->max('price');
    }
}