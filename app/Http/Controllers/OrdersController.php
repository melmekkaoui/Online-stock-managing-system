<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\orderItems;
use App\Models\orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $now = Carbon::now();
        /* $orders = orders::whereBetween("created_at", [
            $now->startOfWeek()->format('Y-m-d'), //This will return date in format like this: 2022-01-10
            $now->endOfWeek()->format('Y-m-d')
         ])->get(); */

            $orders = orders::orderBy('created_at', 'desc')->paginate(50);





        return view('orders.index')->with('orders',$orders);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        
        
        $this->validate($request, [

            'paid_price' => 'required|max:5',
            'discount'   => 'required'

        ]);

        $order=orders::create([
            'client_id'     => $request->client,
            'discount'      => $request->discount,
            'merchant'      => Auth::user()->id,
            'order_price'   => $request->order_price - $request->discount,
            'payed_price'   => $request->paid_price,
            'is_payed'      => true,
            'payment_method'=> $request->paymethod,
            'tracking_number'=> 'commande'.rand(1,999999)
        ]);
        

        $cartItems =cart::where('cart_number',$request->cart_number)->where('Created_by',Auth::user()->id)->get();
        foreach($cartItems as $item){
            orderItems::create([
                'order_id'  => $order->id,
                'client_id' => $request->client,
                'user_id'   => Auth::user()->id,
                'product_id'=> $item->product_id,
                'product_code'=> $item->product_code,
                'product_name'=> $item->product_designation,
                'product_qty'=> $item->product_qty,
                'purchase_price'=> $item->purchase_price,
                'sell_price'    => $item->sell_price,
                'earnings'      => ($item->sell_price * $item->product_qty) - ($item->purchase_price * $item->product_qty),    
            ]);
        }

        cart::destroy($cartItems);

        return redirect('order/'.$order->id);











    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $orders = orders::find($id);
        $orderitems = orderItems::where('order_id',$id)->get();
        return view('orders.invoice')->with('orders',$orders)->with('items',$orderitems);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function edit(orders $orders)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, orders $orders)
    {
        //
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,orders $orders)
    {   
        return $id;
    }
    /**
     * 
     * search 
     * 
     */

     public function delete($id){
        $order= orders::find($id)->delete();

        return redirect('/order');
     }
    public function search(request $request, orders $orders){
        
        $order = $orders::where('tracking_number',$request->tracking_number)->first();
        $orderItems = orderItems::where('order_id',$order->id)->get();
        
       if($order){
            
            return view("orders.single")->with('order',$order)->with('orderItems',$orderItems);
       }
       else{
        return view('404');
       }
        






    }

}
