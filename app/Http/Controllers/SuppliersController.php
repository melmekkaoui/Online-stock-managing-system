<?php

namespace App\Http\Controllers;

use App\Models\suppliers;
use Illuminate\Http\Request;

class SuppliersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        


        $supplier = suppliers::all();
        return view('suppliers.index')->with('suppliers',$supplier);
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
        $validation = $request->validate([
            'supplier_name'  => 'required|unique:suppliers|max:255',
            'supplier_phone' => 'required',
            
        ],[
            'supplier_name.required'  => 'اسم المورد او الشركة مطلوب',
            'supplier_phone.unique'     => 'المورد موجود مسبقا',
            'S_phone.required'  => 'رقم الهاتف مطلوب'
        ]);
        suppliers::create([
            'supplier_name' => $request->supplier_name,
            'supplier_phone' => $request->supplier_phone,
            'supplier_adr'   => $request->supplier_adr,
            'suppliers_balence' => '0',
        ]);
        session()->flash('Add','تم إضافة المورد بنجاح');
        return redirect('/suppliers');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\suppliers  $suppliers
     * @return \Illuminate\Http\Response
     */
    public function show(suppliers $suppliers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\suppliers  $suppliers
     * @return \Illuminate\Http\Response
     */
    public function edit(suppliers $suppliers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\suppliers  $suppliers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, suppliers $suppliers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\suppliers  $suppliers
     * @return \Illuminate\Http\Response
     */
    public function destroy(suppliers $suppliers,Request $request)
    {
        $id = $request->id;
        $suppliers::find($id)->delete();
        session()->flash('delete','تم حذف المورد بنجاح');
        return redirect('/suppliers');
    }
}
