<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bidding;
use App\Models\Advertentie;

class BiddingController extends Controller
{

    private $amountItemsPerPage = 5;
    private $maxAmountOfBidsPerAccount = 4;

    public function index() {

        $others_bids = false;
        $personalBids = Bidding::where('user_id', auth()->user()->id)
            ->paginate($this->amountItemsPerPage);

        return view('bids.index', [
            'bids' => $personalBids,
            'others_bids' => $others_bids
        ]);
    }

    public function create(int $id) {
        $advertentie = Advertentie::find($id);
        return view('bids.create', [
            'advertentie' => $advertentie,
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'user_id' => 'required',
            'ad_id' => 'required',
            'price' => 'required',
        ]);
    
        $valid = $this->checkAmountAdvertisementsAccount($request);
        if ($valid) {
            // Validate if the bid is higher than the current highest bid
            $highestBid = Bidding::where('ad_id', $request->ad_id)->max('price');
            if ($request->price <= $highestBid) {
                return redirect()->back()->withErrors(['price' => __("Bid is less than the current highest bid (€$highestBid)")]);
            }
    
            Bidding::create($request->all());
    
            return redirect()->route('bidding.index');
        } else {
            return redirect()->back()->withErrors(['price' => __("You already have the most amount of bids allowed (4)")]);
        }
    }
    

    public function show(Bidding $bidding) {
        return view('bids.show', [
            'bidding' => $bidding,
            'advertenties' => $bidding->ad(),
        ]);
    }

    public function edit(Bidding $bidding) {
        $advertentie = Advertentie::find($bidding->ad_id);
        return view('bids.edit', [
            'bidding' => $bidding,
            'advertentie' => $advertentie,
        ]);
    }

    public function update(Request $request, Bidding $bidding) {
        $request->validate([
            'user_id' => 'required',
            'ad_id' => 'required',
            'price' => 'required',
        ]);

        // Validate if the bid is higher than the current highest bid
        $highestBid = Bidding::where('ad_id', $request->ad_id)->max('price');
        if ($request->price <= $highestBid) {
            return redirect()->back()->withErrors(['price' => __("Bid is less than the current highest bid (€$highestBid)")]);
        }

        $bidding->update($request->all());

        return redirect()->route('bidding.index');
    }

    public function destroy(Bidding $bidding) {
        $bidding->delete();

        return redirect()->route('bidding.index');
    }

    public function othersBids(){


        $others_bids = true;
        $all_bids = Bidding::all();
    
        //-- Haal hier alle verhuur advertenties van artikelen die op jouw naam staan.
        $personalBiddingsQuery = Bidding::query();
        foreach($all_bids as $bid){
            $advertentie = Advertentie::findOrFail($bid->ad_id);
            if($advertentie->user_id === auth()->id()){
                $personalBiddingsQuery->where('id', $bid->id);
            }
        }
    
        $all_bids = $personalBiddingsQuery->paginate($this->amountItemsPerPage);
    
        return view('bids.index', [
            'bids' => $all_bids,
            'others_bids' => $others_bids,
        ]);


    }

    private function checkAmountAdvertisementsAccount($request){


        $highestBids = [];
        $bids = Bidding::where('user_id', auth()->user()->id)->get();

        foreach($bids as $bid){
            if($bid->isHighestBid($bid->ad_id, $bid->price)){
                $highestBids[] = $bid;
            }
        }

        if($this->maxAmountOfBidsPerAccount > count($highestBids)){
            return true;
        } else{
            return false;
        }
    }
}
