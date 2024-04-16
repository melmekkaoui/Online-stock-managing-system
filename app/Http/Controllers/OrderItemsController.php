<?php

namespace App\Http\Controllers;

use App\Models\orderItems;
use App\Models\orders;
use App\Models\products;
use Illuminate\Http\Request;

class OrderItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $orderItems = orderItems::orderBy('created_at', 'desc')->paginate(500);
        return view('orderItems.index')->with('orderItems',$orderItems);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\orderItems  $orderItems
     * @return \Illuminate\Http\Response
     */
    public function show(orderItems $orderItems)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\orderItems  $orderItems
     * @return \Illuminate\Http\Response
     */
    public function edit(orderItems $orderItems)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\orderItems  $orderItems
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, orderItems $orderItems)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\orderItems  $orderItems
     * @return \Illuminate\Http\Response
     */
    public function destroy(orderItems $orderItems)
    {
        //
    }
    public function delete($id){
        $orderItem = orderItems::find($id);
        $updateOrderItem = products::where('id',$orderItem->product_id)->increment('product_qty',($orderItem->product_qty));
        $updateOrderPrice = orders::where('id',$orderItem->order_id)->decrement(
            'order_price',($orderItem->product_qty * $orderItem->sell_price));

        $delete = $orderItem->delete();
        
        return redirect('/order');








    }
}
