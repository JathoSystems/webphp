<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
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

        // Process the iamge
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $file = $request->file('image');
            $imageUrl = Storage::disk('content_CMS')->put('images', $file);
            $ad->image = json_encode(['url' => $imageUrl]);
        }
       
        //-- Voeg velden toe uit request om ze op te slaan in DB
        $ad->title = $request->input('title');
        $ad->description = $request->input('description');
        $ad->price = $request->input('price');
        $ad->type = $request->input('type');

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
            'existing_image' => 'nullable|string',
            'image' => 'required_without:existing_image|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        $ad = Ad::find($id);

        $valid = false;
        if($request->existing_image && !$request->image){
            $valid = true;
        }
        

        if(!$valid){
            // Delete the old image if it exists
            $image = json_decode($ad->image, true);
            if (!empty($image['url']) && Storage::disk('content_CMS')->exists($image['url'])) {
                Storage::disk('content_CMS')->delete($image['url']);
            }

            // Process the new thumbnail
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $file = $request->file('image');
                $imageUrl = Storage::disk('content_CMS')->put('images', $file);
                $ad->image = json_encode(['url' => $imageUrl]);
            }   
        }

        //-- Voeg velden toe uit request om ze op te slaan in DB
        $ad->title = $request->input('title');
        $ad->description = $request->input('description');
        $ad->price = $request->input('price');
        $ad->type = $request->input('type');
        $ad->save();

        return redirect()->route('ads.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ad = Ad::findOrFail($id);
        // Delete the image if it exists
        $image = json_decode($ad->image, true);
        if (!empty($image['url']) && Storage::disk('content_CMS')->exists($image['url'])) {
            Storage::disk('content_CMS')->delete($image['url']);
        }

        $ad->delete();
        return redirect()->route('ads.index');
    }
}
