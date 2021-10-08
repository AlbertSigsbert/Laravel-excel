<?php

namespace App\Http\Controllers;

use App\Exports\OrdersExport;
use App\Order;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::latest()->paginate(5);
       return view('orders.order')->with('orders', $orders);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('orders.create');
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
            'quantity'=> 'required|integer',
            'units'=> 'required|integer'
        ]);

        Order::create($request->all());

        return redirect()->route('orders')
                        ->with('success','Order created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    // public function show(Order $order)
    // {
    //     return view('orders.show')->with('order', $order);

    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        return view('orders.edit',compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'items' => 'required',
            'descriptions' => 'required',
            'descriptions' => 'required',
            'quantity'=> 'required|integer',
            'units'=> 'required|integer'
        ]);

        $order->update($request->all());

        return redirect()->route('orders')
                        ->with('success','Order updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('orders')
        ->with('success','Order deleted successfully.');
    }

    public function export()
    {
        return Excel::download(new OrdersExport, 'orders.xlsx');
    }
}
