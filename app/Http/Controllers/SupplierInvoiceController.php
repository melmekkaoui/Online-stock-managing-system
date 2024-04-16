<?php

namespace App\Http\Controllers;

use App\Models\suppliercart;
use App\Models\supplierInvoice;
use App\Models\supplierInvoiceItems;
use App\Models\suppliers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = supplierInvoice::all();
        
    
        return view('suppliers.supplierInvoices')->with('inv',$invoices);
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
        
        $invoice=supplierInvoice::create([
            'supplier_id' => $request->supplier_id,
            'invoice_tracking' => 'facture'.rand(1,30000),
            'payment_status'   => $request->payment_status,
            'invoice_price'    => $request->invoice_price,
            'paid_price'       => $request->paid_price,
        ]);

        $supcart = suppliercart::all();

        foreach($supcart as $x){
            supplierInvoiceItems::create([
                'invoice_id' => $invoice->id,
                'product_name' => $x->product_name,
                'product_qty'  => $x->product_qty,
                'product_price' => $x->product_price,
                'Created_by'    => Auth::user()->id,
            ]);
        }
        suppliercart::destroy($supcart);
        return redirect('supplierInvoice/'.$invoice->id);


    } 

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\supplierInvoice  $supplierInvoice
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
        $inv = supplierInvoice::find($id);
        $suppItm = supplierInvoiceItems::where('invoice_id',$id)->get();
        $supplier = suppliers::find($inv->supplier_id);
        return view('suppliers.invoice')->with('inv',$inv)->with('items',$suppItm)->with('supp',$supplier);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\supplierInvoice  $supplierInvoice
     * @return \Illuminate\Http\Response
     */
    public function edit(supplierInvoice $supplierInvoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\supplierInvoice  $supplierInvoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, supplierInvoice $supplierInvoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\supplierInvoice  $supplierInvoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(supplierInvoice $supplierInvoice)
    {
        //
    }
    public function delete($id){
        supplierInvoice::find($id)->delete();
        session()->flash('delete','تم حذف الفاتورة بنجاح');
        return redirect()->back();
    }
}
