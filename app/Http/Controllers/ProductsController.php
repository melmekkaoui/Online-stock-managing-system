<?php

namespace App\Http\Controllers;

use App\Models\products;
use App\Models\units;
use App\Models\sections;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $products = products::all();
        return view('products.index')->with('products',$products)->with('section',sections::all())->with('units',units::all());
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
        products::create([
            'section_id'        => $request->section_id,
            'unit_id'           => $request->unit_id,
            'experation_date'   => $request->exp_date,
            'product_designation'=> $request->product_desig,
            'product_qty'        => $request->product_qty,
            'critical_qty'       => $request->crt_qty,
            'purchase_price'     => $request->purchase_price,
            'sell_price'         => $request->selling_price,
            'code1'              => $request->code_1,
            'code2'              => $request->code_2,
            'code3'              => $request->code_3,
            'code4'              => $request->code_4,
            'code5'              => $request->code_5,
            'code6'              => $request->code_6,
            'code7'              => $request->code_7,
            'code8'              => $request->code_8,
        ]);
        session()->flash('Add','تم إضافة المنتج بنجاح');
        return redirect('/products');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit($id ,products $products)
    {  
       
        $product = products::find($id);
        return view('products.edit')->with('product',$product);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, products $products)
    {
        //
        $product = products::where('id',$request->product_id)->update([
            'section_id'        => $request->section_id,
            'unit_id'           => $request->unit_id,
            'experation_date'   => $request->exp_date,
            'product_designation'=> $request->product_name,
            'product_qty'        => $request->product_qty,
            'critical_qty'       => $request->critical_qty,
            'purchase_price'     => $request->purchase_price,
            'sell_price'         => $request->sell_price,
            'code1'              => $request->code1, 
            'code2'              => $request->code2,
            'code3'              => $request->code3,
            'code4'              => $request->code4,
            'code5'              => $request->code5,
            'code6'              => $request->code6,
            'code7'              => $request->code7,
            'code8'              => $request->code8,
        ]);
        session()->flash('Add','تم إضافة المنتج بنجاح');
        return redirect('/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(products $products)
    {
        //
    }
    public function getBySection($id){
        $products = DB::table("products")->where("section_id",$id)->pluck("product_designation","code1");
        return json_encode($products);
    }
}
