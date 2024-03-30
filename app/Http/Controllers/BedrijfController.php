<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BedrijfController extends Controller
{
    public function index()
    {
        return view('company.index', [
            'companies' => \App\Models\Bedrijf::all(),
        ]);
    }

    public function create()
    {
        return view('company.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'logo' => 'required|file|image|max:2048',
            'color_scheme' => 'required',
        ]);

        $date = now()->format('YmdHis');

        // change logo filename to date and time
        $request->file('logo')->storeAs('public/images', $date . '.' . $request->file('logo')->extension());

        $logo_url = $date . '.' . $request->file('logo')->extension();

        $request->merge([
            'logo_url' => $logo_url,
        ]);

        $company = auth()->user()->company()->create($request->all());

        return redirect()->route('company.show', $company);
    }

    public function edit($id)
    {
        $company = \App\Models\Bedrijf::findOrFail($id);

        return view('company.edit', [
            'company' => $company,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'logo' => 'sometimes|image|file|max:2048',
            'color_scheme' => 'required',
        ]);
        
        $company = \App\Models\Bedrijf::findOrFail($id);

        if ($request->hasFile('logo')) {
            $date = now()->format('YmdHis');

            // change logo filename to date and time
            $request->file('logo')->storeAs('public/images', $date . '.' . $request->file('logo')->extension());

            $logo_url = $date . '.' . $request->file('logo')->extension();

            $request->merge([
                'logo_url' => $logo_url,
            ]);
        }

        $company->update($request->all());

        return redirect()->route('company.show', $company);
    }

    public function show($id)
    {
        $company = \App\Models\Bedrijf::findOrFail($id);

        return view('company.show', [
            'company' => $company,
        ]);
    }

    public function destroy($id)
    {
        $company = \App\Models\Bedrijf::findOrFail($id);
        $company->delete();

        return redirect()->route('company.index');
    }
}
