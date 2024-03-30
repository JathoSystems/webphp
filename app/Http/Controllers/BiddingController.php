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
        return view('bids.edit', [
            'bidding' => $bidding,
        ]);
    }

    public function update(Request $request, Bidding $bidding) {
        $request->validate([
            'user_id' => 'required',
            'ad_id' => 'required',
            'price' => 'required',
        ]);

        $bidding->update($request->all());

        return redirect()->route('bidding.index');
    }

    public function destroy(Bidding $bidding) {
        $bidding->delete();

        return redirect()->route('bidding.index');
    }
}
