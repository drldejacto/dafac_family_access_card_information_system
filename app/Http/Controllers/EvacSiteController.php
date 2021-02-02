<?php

namespace App\Http\Controllers;

use App\EvacSite;
use Illuminate\Http\Request;

class EvacSiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
         $evacSite = EvacSite::all()->where('status',1);

        return view('evacSite.index')->with('evacSite',$evacSite);
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
        $evacSite = new EvacSite;
        $evacSite->evacuation_site = $request->evacuation_site;
        $evacSite->status = 1;
        $evacSite->save();

        $evacSite = EvacSite::all()->where('status',1);
        return view('evacSite.index')->with('evacSite',$evacSite);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EvacSite  $evacSite
     * @return \Illuminate\Http\Response
     */
    public function show(EvacSite $evacSite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EvacSite  $evacSite
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $evacSite = EvacSite::findorfail($id);

        return view('evacSite.edit')->with('evacSite',$evacSite);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EvacSite  $evacSite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $evac = EvacSite::findorfail($id);
        $evac->evacuation_site = $request->evacuation_site;
        $evac->update();

        $evac = EvacSite::all()->where('status',1);

        return view('evacSite.index')->with('evacSite',$evac);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EvacSite  $evacSite
     * @return \Illuminate\Http\Response
     */
    public function destroy(EvacSite $evacSite)
    {
        //
    }

    public function deleteEvacSite($id){
        $evacSite = EvacSite::findorfail($id);
        $evacSite->status = 2;
        $evacSite->update();

        $evacSite = EvacSite::all()->where('status',1);

        return view('evacSite.index')->with('evacSite',$evacSite);
    }
}
