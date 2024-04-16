<?php

namespace App\Http\Controllers;

use App\Models\units;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UnitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $units = units::all();
        return view('units.index',compact('units'));
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
            'unit_name'  => 'required|unique:units|max:255',
            
        ],[
            'unit_name.required'=> 'يرجى ادخال اسم الوحدة',
            'unit_name.unique'=>'اسم القسم مسجل مسبقا',
            
        ]);
    
        units::create([
            'unit_name' => $request->unit_name,
            'description'  => $request->desc,
            'Created_by'   => (Auth::user()->name),
        ]);
        session()->flash('Add','تم إضافة الوحدة بنجاح');
        return redirect('/units');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\units  $units
     * @return \Illuminate\Http\Response
     */
    public function show(units $units)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\units  $units
     * @return \Illuminate\Http\Response
     */
    public function edit(units $units)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\units  $units
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, units $units)
    {
        $id = $request->id;

        $this->validate($request, [

            'unit_name' => 'required|max:255|unique:units,unit_name,'.$id,
           
        ],[

            'unit_name.required' =>'يرجي ادخال اسم الوحدة',
            'unit_name.unique' =>'اسم الوحدة مسجل مسبقا',
            

        ]);

        $units = units::find($id);
        $units->update([
            'unit_name' => $request->unit_name,
            'description' => $request->description,
        ]);

        session()->flash('edit','تم تعديل الوحدة بنجاج');
        return redirect('/units');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\units  $units
     * @return \Illuminate\Http\Response
     */
    public function destroy(request $request,units $units)
    {
        $id = $request->id;
        units::find($id)->delete();
        session()->flash('delete','تم حذف الوحدة بنجاح');
        return redirect('/units');
    }
}
