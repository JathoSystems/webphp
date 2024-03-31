<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contract;
use App\Models\Bedrijf;
use Spatie\LaravelPdf\Facades\Pdf;

class ContractController extends Controller
{
    public function index()
    {


        $contracts = [];
        if(auth()->user()->hasRole("admin")){
            $contracts = Contract::all();
        } else{
            //-- User called page with zakelijke user
            $company = Bedrijf::where('user_id', auth()->user()->id)->first();
            $contracts = Contract::where('bedrijf_id', $company->id)
            ->get();
        }

        return view('contracts.index', [
            'contracts' => $contracts,
        ]);
    }

    
    public function create()
    {
        if(auth()->user()->hasRole("admin")){
            return view('contracts.create', [
                'companies' => Bedrijf::all(),
            ]);
        } else{
            return redirect()->back();
        }
        
    }

    public function store(Request $request)
    {
        if(auth()->user()->hasRole("admin")){
            $date = now()->format('YmdHis');
            $default_prefix = "storage/pdfs/";
            $company_key = $date . "." . $request->company . ".pdf";
            $full_key = $default_prefix . $company_key;
            $customPdfPath = public_path($full_key);

            $company = Bedrijf::find($request->company);

            //-- Maak PDF aan en sla die op.
            $pdf = PDF::view('contracts.template', ['company' => $company])
                ->format('a4')
                ->save($customPdfPath);   

            Contract::create([
                'bedrijf_id' => $request->company,
                'approved' => false,
                'file' => $company_key,
            ]);

            return redirect()->route('contract.index');
        } else{
            return redirect()->back();
        }
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

    public function approve(string $id){
        $contract = Contract::findOrFail($id);
        $contract->approved = 1;
        $contract->save();
        return redirect()->route('contract.index');
    }
}
