<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Penerimaan;

class PenerimaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $penerimaan=Penerimaan::where('status','0')->get(); 
        return view('penerimaan.index',compact('penerimaan'));
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
        $request->validate([

            'qty'=>'required']);
        Penerimaan::create($request->except('submit'));
        return redirect()->route('penerimaan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        $penerimaan=Penerimaan::where('status','0');
        $penerimaan->update(['status'=>'1']);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $penerimaan=Penerimaan::findOrFail($id);
        if(!$penerimaan){
        return redirect()->back(); 
        }
        $penerimaan->delete();
        return redirect()->route('penerimaan.index');   
    }
}
