<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        return view('company.index', [
            'companies' => \App\Models\Company::all(),
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
            'email' => 'required|email',
            'website' => 'required',
            'logo' => 'required|image',
        ]);

        $logo = $request->file('logo')->store('logos');

        $company = auth()->user()->company()->create([
            'name' => $request->name,
            'email' => $request->email,
            'website' => $request->website,
            'logo' => $logo,
        ]);

        return redirect()->route('company.show', $company);
    }

    public function edit($id)
    {
        $company = \App\Models\Company::findOrFail($id);

        return view('company.edit', [
            'company' => $company,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'website' => 'required',
            'logo' => 'image',
        ]);

        $company = \App\Models\Company::findOrFail($id);

        $company->update([
            'name' => $request->name,
            'email' => $request->email,
            'website' => $request->website,
        ]);

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo')->store('logos');
            $company->update([
                'logo' => $logo,
            ]);
        }

        return redirect()->route('company.show', $company);
    }

    public function destroy($id)
    {
        $company = \App\Models\Company::findOrFail($id);
        $company->delete();

        return redirect()->route('company.index');
    }
}
