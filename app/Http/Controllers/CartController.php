<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\clients;
use App\Models\products;
use App\Models\sections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $cart = cart::where('cart_number',1)->where('Created_by',Auth::user()->id)->get();
        $prices = cart::where('cart_number',1)->where('Created_by',Auth::user()->id)->sum('subtotal');
        $section = sections::all();
        $clients = clients::all();
        return view('cart.index')->with('cart',$cart)->with('sections',$section)->with("total",$prices)->with('clients',$clients);
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
        $code = ($request->code) ? $request->code : $request->code2;
        // search for the code
        $product = products::where('code1', $code)
                                ->orWhere('code2', $code)
                                ->orWhere('code2', $code)
                                ->orWhere('code3', $code)
                                ->orWhere('code4', $code)
                                ->orWhere('code5', $code)
                                ->orWhere('code6', $code)
                                ->orWhere('code7', $code)
                                ->orWhere('code8', $code)
                                ->first();
        $array = json_decode(json_encode($product), true);
        
        
                            
        if(!is_null($product)){ 
            try{
                cart::create([
                    'product_id' => $product->id,
                    'product_code' => $code,
                    'product_unit' => $product->unit_id,
                    
                    'product_designation'=>$product->product_designation,
                    'product_qty'        =>$request->qty,
                    "purchase_price"    => $product->purchase_price,
                    "sell_price"        => $product->sell_price,
                    "Created_by"       => (Auth::user()->id),
                    "cart_number"      => $request->cart_number,
                    "subtotal"         => $request->qty * $product->sell_price
                ]);
                session()->flash('Add','تم إضافة العنصر بنجاح');
            }catch(Exception $e){
                session()->flash('error',$e);

            }
        
        }
        else{
            session()->flash('error','العنصر غير موجود');
        } 
        

           /*  
            //check the resault
                 if(!is_null($product)){ 
                    cart::create([
                        'product_id' => $product->id,
                        'product_code' => $code,
                        'product_designation'=>$product->product_designation,
                        'product_qty'        =>$request->qty,
                        "purchase_price"    => $product->purchase_price,
                        "sell_price"        => $product->sell_price,
                        "Created_by"       => (Auth::user()->name),
                        "cart_number"      => $request->cart_number,
                    ]);
                    session()->flash('Add','تم إضافة العنصر بنجاح');
                }
                else{
                    session()->flash('error','العنصر غير موجود');
                } 
 */
                

                
//return var_dump($array);
            






                
       
        return redirect()->back(); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, cart $cart)
    {
        $id = $request->product_id;

        $this->validate($request, [

            'sell_price' => 'required',
            'product_qty' => 'required',
           
        ],[

            'sell_price.required' =>'يرجى كتابة الثمن',
            'product_qty.required' =>'يرجى كتابة الكمية',
        ]);

        $cart = cart::find($id);
        $cart->update([
            'sell_price' => $request->sell_price,
            'product_qty' => $request->product_qty,
            'subtotal'    => $request->sell_price * $request->product_qty,
            
            ]);

        session()->flash('edit','تم تعديل الثمن والكمية بنجاج');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,cart $cart)
    {
        
        cart::find($id)->delete();
        session()->flash('delete','تم حذف الزبون بنجاح');
        return redirect('/clients');
    }

    public function deleteItem($id){
        cart::find($id)->delete();
        session()->flash('delete','تم حذف المنتج بنجاح');
        return redirect()->back();
    }

    /*** ------------------------------------------- custom functions **************************************** */
    public function showCart($id){
        $clients = clients::all();
        $cart = cart::where('cart_number',$id)->where('Created_by',Auth::user()->id)->get();
        $section = sections::all();
        $prices = cart::where('cart_number',$id)->where('Created_by',Auth::user()->id)->sum('subtotal');

        
        return view('cart.secondcarte')->with('cart',$cart)
                ->with('sections',$section)
                ->with('cart_number',$id)
                ->with('total',$prices)->with('clients',$clients);
    }
    public function empty($id){
        $product = cart::where('cart_number',$id)->where('Created_by',(Auth::user()->id))->delete();
        return redirect()->back();

    }
    public function storeCustomProduct(request $request){

        try{
            cart::create([
                'product_id' => rand(10000,12000),
                'product_code' => 6111+rand(1,2000),
                'product_unit'=> 1,
                'product_designation'=>$request->pname,
                'product_qty'        =>$request->qty,
                "purchase_price"    => $request->sell_price - 1,
                "sell_price"        => $request->sell_price,
                "Created_by"       => (Auth::user()->id),
                "cart_number"      => $request->cart_number,
                "subtotal"         => $request->qty * $request->sell_price
            ]);
            session()->flash('Add','تم إضافة العنصر بنجاح');
        }catch(Exception $e){
            session()->flash('error',$e);

        }
        return redirect()->back();
        
    }
}
