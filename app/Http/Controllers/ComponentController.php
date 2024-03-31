<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bedrijf;
use App\Models\Component;

class ComponentController extends Controller
{
    public function index($company_id)
    {
        $company = Bedrijf::find($company_id);
        $components = $company->components;
        return view('company.components.index', [
            'components' => $components,
            'company' => $company,
        ]);
    }

    public function create($company_id)
    {
        $company = Bedrijf::find($company_id);
        return view('company.components.create', [
            'company' => $company,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'order' => 'required',
        ]);

        $company_id = $request->company_id;

        $company = Bedrijf::find($company_id);
        
        $component = $company->components()->create($request->all());

        return redirect()->route('component.index', $company_id);
    }

    public function edit($component_id)
    {
        $component = Component::find($component_id);
        return view('company.components.edit', [
            'component' => $component,
        ]);
    }

    public function update(Request $request, $component_id)
    {
        $request->validate([
            'order' => 'required',
        ]);

        // Image
        if ($request->hasFile('image')) {
            $date = now()->format('YmdHis');
            
            $request->file('image')->storeAs('public/images', $date . '.' . $request->file('image')->extension());

            $imageName = $date . '.' . $request->file('image')->extension();

            $request->merge(['image_url' => $imageName]);
        }

        $component = Component::find($component_id);
        $component->update($request->all());

        $company_id = $component->bedrijf->id;

        return redirect()->route('component.index', $company_id);
    }

    public function destroy($component_id)
    {
        $component = Component::find($component_id);
        $component->delete();

        return redirect()->route('company.components.index', $company_id);
    }

}
