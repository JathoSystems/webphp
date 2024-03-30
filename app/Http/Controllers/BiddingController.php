<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bidding;
use App\Models\Advertentie;

class BiddingController extends Controller
{
    public function index() {
        return view('bids.index', [
            'bids' => Bidding::all(),
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

        // Validate if the bid is higher than the current highest bid
        $highestBid = Bidding::where('ad_id', $request->ad_id)->max('price');
        if ($request->price <= $highestBid) {
            return redirect()->back()->withErrors(['price' => __("Bid is less than the current highest bid (€$highestBid)")]);
        }

        // Validate if the user has 4 or more bids
        $bids = Bidding::where('user_id', $request->user_id)->count();
        if ($bids >= 4) {
            return redirect()->back()->withErrors(['price' => __("Bid limit (4) reached")]);
        }

        Bidding::create($request->all());

        return redirect()->route('bidding.index');
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
}
