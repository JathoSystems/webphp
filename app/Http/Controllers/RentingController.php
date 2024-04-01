<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Renting;
use App\Models\Advertentie;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;



class RentingController extends Controller
{

    private $amountItemsPerPage = 5;

    public function index()
    {

        $hired_by_others = false;
        $personalRentals = Renting::where('user_id', auth()->user()->id)
            ->orderBy('date_from', 'asc')
            ->paginate($this->amountItemsPerPage);

        return view('renting.index', [
            'rentingArticles' => $personalRentals,
            'hired_by_others' => $hired_by_others,
        ]);
    }

    public function create(int $id) {
        $advertentie = Advertentie::find($id);
        return view('renting.create', [
            'advertentie' => $advertentie,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date_from' => 'required|date|date_format:Y-m-d',
            'date_to' => 'required|date|date_format:Y-m-d|after:date_from',
        ], [
            'date_from.required' => 'Het veld date_from is verplicht.',
            'date_to.required' => 'Het veld date_to is verplicht.',
            'date_from.date_format' => 'Het veld date_from moet in het formaat YYYY-MM-DD zijn.',
            'date_to.date_format' => 'Het veld date_to moet in het formaat YYYY-MM-DD zijn.',
            'date_to.after' => 'Het veld date_to moet na date_from komen.',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $overlappingBooking = self::validateArticleRentPeriod($request);
        if($overlappingBooking){
            return redirect()->back()->withErrors(['date_from' => __("This article has been rented out during this period (from: $overlappingBooking->date_from to $overlappingBooking->date_to)")]);
        } 

        // Validate if the user has 4 or more rentings
        $rentings = Renting::where('user_id', $request->user_id)->count();
        if ($rentings >= 4) {
            return redirect()->back()->withErrors(['date_to' => __("renting limit (4) reached")]);
        }

        Renting::create($request->all());
        return redirect()->route('renting.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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

    private function validateArticleRentPeriod(Request $request){

        $rentings = Renting::where('ad_id', $request->ad_id)->get();

        foreach ($rentings as $renting) {
            $existingDateFrom = Carbon::parse($renting->date_from);
            $existingDateTo = Carbon::parse($renting->date_to);
        
            $requestedDateFrom = Carbon::parse($request->date_from);
            $requestedDateTo = Carbon::parse($request->date_to);
        
            if (($requestedDateFrom >= $existingDateFrom && $requestedDateFrom <= $existingDateTo) ||
                ($requestedDateTo >= $existingDateFrom && $requestedDateTo <= $existingDateTo) ||
                ($requestedDateFrom <= $existingDateFrom && $requestedDateTo >= $existingDateTo)) {
                return $renting;
            }
        }
        return null;
    }

    public function personal(){

        $hired_by_others = true;
        $all_rentals = Renting::all();
    
        //-- Haal hier alle verhuur advertenties van artikelen die op jouw naam staan.
        $personalRentalsQuery = Renting::query();
        foreach($all_rentals as $ar){
            $advertentie = Advertentie::findOrFail($ar->ad_id);
            if($advertentie->user_id === auth()->id()){
                $personalRentalsQuery->where('id', $ar->id);
            }
        }
    
        $personalRentals = $personalRentalsQuery->paginate($this->amountItemsPerPage);
    
        return view('renting.index', [
            'rentingArticles' => $personalRentals,
            'hired_by_others' => $hired_by_others,
        ]);
    }
    
}
