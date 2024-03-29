<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Ad;


class adController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ads = Ad::all();
        return view('ads.index')->with('ads', $ads);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ads.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'price' => 'required|number',
            'price' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|file|mimes:jpg,jpeg,png|max:2048', // 2MB Max
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        $ad = new Ad();
        // Process the thumbnail

        /** 
            if ($request->hasFile('image') && $request->file('thumbnail')->isValid()) {
                $file = $request->file('thumbnail');
                $thumbnailUrl = Storage::disk('content_CMS')->put('thumbnails', $file);
                $exposant->thumbnail = json_encode(['url' => $thumbnailUrl]);
            }
        */
       
        //-- Voeg velden toe uit request om ze op te slaan in DB
        $ad->title = $request->input('title');
        $ad->description = $request->input('description');
        $ad->price = $request->input('price');
        $ad->type = $request->input('type');
        $ad->image = "placeholder";

        $ad->save();

        return redirect()->route('ads.index');
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
        $ad = Ad::find($id);
        return view('ads.create', compact('ad'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {


        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'price' => 'required|number',
            'price' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|file|mimes:jpg,jpeg,png|max:2048', // 2MB Max
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $ad = Ad::find($id);

        //-- Voeg velden toe uit request om ze op te slaan in DB
        $ad->title = $request->input('title');
        $ad->description = $request->input('description');
        $ad->price = $request->input('price');
        $ad->type = $request->input('type');
        $ad->image = "placeholder";

        $ad->save();

        return redirect()->route('ads.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ad = Ad::findOrFail($id);
        $ad->delete();
        return redirect()->route('ads.index');
    }
}
