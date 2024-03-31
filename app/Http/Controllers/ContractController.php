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
        return view('contracts.index', [
            'contracts' => Contract::all(),
        ]);
    }

    
    public function create()
    {
        return view('contracts.create', [
            'companies' => Bedrijf::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

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
}
