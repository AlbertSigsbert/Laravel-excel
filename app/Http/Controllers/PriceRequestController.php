<?php

namespace App\Http\Controllers;

use App\Exports\PriceRequestExport;
use App\PriceRequest;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PriceRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $priceRequests = PriceRequest::latest()->paginate(5);
       return view('pricerequests.index')->with('priceRequests', $priceRequests );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pricerequests.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required',
            'descriptions' => 'required',
            'descriptions' => 'required',
            'quantity'=> 'required|integer|gt:0',
            'units'=> 'nullable|integer|gt:0',
            'price' => 'required|integer|gt:0',
            'cost' => 'integer|gt:0'
        ]);

        PriceRequest::create($request->all());

        return redirect()->route('price-requests.index')
                        ->with('success','Price Request made successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PriceRequest  $priceRequest
     * @return \Illuminate\Http\Response
     */
    public function show(PriceRequest $priceRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PriceRequest  $priceRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(PriceRequest $priceRequest)
    {
        return view('pricerequests.edit')->with('request', $priceRequest);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PriceRequest  $priceRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PriceRequest $priceRequest)
    {
        $request->validate([
            'items' => 'required',
            'descriptions' => 'required',
            'descriptions' => 'required',
            'quantity'=> 'required|integer|gt:0',
            'units'=> 'nullable|integer|gt:0'
        ]);

        $priceRequest->update($request->all());

        return redirect()->route('price-requests.index')
                        ->with('success','Price request updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PriceRequest  $priceRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(PriceRequest $priceRequest)
    {
        $priceRequest->delete();

        return redirect()->route('price-requests.index')
        ->with('success','Price Request deleted successfully.');
    }

    public function export()
    {
        return Excel::download(new PriceRequestExport,'price-requests.xlsx');
    }
}
