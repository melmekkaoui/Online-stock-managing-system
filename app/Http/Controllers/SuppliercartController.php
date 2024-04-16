<?php

namespace App\Http\Controllers;

use App\Models\suppliercart;
use App\Models\suppliers;
use Illuminate\Http\Request;

class SuppliercartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $sup = suppliers::query()
        ->orderBy('id', 'desc')
        ->get();
        $pr = suppliercart::all();

        return view('suppcart.index')->with('pr',$pr)->with('sups',$sup);
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
        suppliercart::create([
            'product_name' => $request->product_name,
            'product_qty'   => $request->qty,
            'product_price' => $request->price
        ]);
        session()->flash('Add','تم إضافة المنتج بنجاح');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\suppliercart  $suppliercart
     * @return \Illuminate\Http\Response
     */
    public function show(suppliercart $suppliercart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\suppliercart  $suppliercart
     * @return \Illuminate\Http\Response
     */
    public function edit(suppliercart $suppliercart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\suppliercart  $suppliercart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, suppliercart $suppliercart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\suppliercart  $suppliercart
     * @return \Illuminate\Http\Response
     */
    public function destroy(suppliercart $suppliercart)
    {
        //
    }
    public function delete($id){
        suppliercart::find($id)->delete();
        session()->flash('delete','تم حذف المنتج بنجاح');
        return redirect()->back();
    }
}
