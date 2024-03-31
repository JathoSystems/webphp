<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Review;


class AdverteerderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $advertisers = self::getAdvertisers();
        return view('advertisers.index', [
            'advertisers' => $advertisers,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id); 
        $reviews = Review::where('advertiser_id', $id)->get();

        return view('advertisers.show', [
            'advertiser' => $user,
            'reviews' => $reviews,
        ]);
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

    public function review(string $id)
    {
        $advertiser = User::findOrFail($id); 
        return view('advertisers.review', [
            'advertiser' => $advertiser,
        ]);
    }

    public function addReview(Request $request)
    {
        $advertiser = User::findOrFail($request->advertiser_id);

        $newReview = new Review();
        $newReview->user_id = $request->user_id;
        $newReview->advertiser_id = $request->advertiser_id;
        $newReview->remarks = $request->remarks;
        $newReview->save();
    
        // $advertiser->reviews()->save($newReview);
    
        return redirect()->route('advertisers.show', $advertiser->id);

    }

    

    private function getAdvertisers(){
        $all_users = User::all();
        $advertisers = [];

        foreach($all_users as $user) {
            if ($user->hasRole("zakelijk") || $user->hasRole("particulier")) {
                $advertisers[] = $user;
            }
        }

        return $advertisers;
    }
}
