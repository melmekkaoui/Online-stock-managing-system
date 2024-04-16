<?php

namespace App\Http\Controllers;

use App\Models\clients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = clients::all();
        return view('clients.index')->with('clients',$clients);

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
            'fname'  => 'required|max:255',
            'lname'  => 'required',
            
        ],[
            'fname.required'=> 'يرجى ادخال اسم الزبون',
            'lname.required'=>'يرجى ادخال النسب',
            
        ]);
    
        clients::create([
            'fname' => $request->fname,
            'lname'  => $request->lname,
            'phone_number'=> $request->phone_number,
            'adresse'     => "no adresse",
            'Created_by'   => (Auth::user()->name),
        ]);
        session()->flash('Add','تم إضافة القسم الزبون');
        return redirect('/clients');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\clients  $clients
     * @return \Illuminate\Http\Response
     */
    public function show(clients $clients)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\clients  $clients
     * @return \Illuminate\Http\Response
     */
    public function edit(clients $clients)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\clients  $clients
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, clients $clients)
    {
        //
        $id = $request->id;

        $this->validate($request, [

            'fname' => 'required|max:255',
            'lname' => 'required|max:255',
            'phone_number'  => 'required',
           
        ],[

            'fname.required' =>'يرجى ادخال اسم الزبون',
            'lname.required' =>'يرجى ادخال الكنية',
            'phone_number'  => 'يرجى كتابة رقم الهاتف صحيح'
            

        ]);

        $clients = clients::find($id);
        $clients->update([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'phone_number'=> $request->phone_number,
            ]);

        session()->flash('edit','تم تعديل الزبون بنجاج');
        return redirect('/clients');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\clients  $clients
     * @return \Illuminate\Http\Response
     */
    public function destroy(request $request,clients $clients)
    {
        $id = $request->id;
        clients::find($id)->delete();
        session()->flash('delete','تم حذف الزبون بنجاح');
        return redirect('/clients');
    }
}
