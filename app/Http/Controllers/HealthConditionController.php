<?php

namespace App\Http\Controllers;

use App\HealthCondition;
use Illuminate\Http\Request;

class HealthConditionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $hc = HealthCondition::all()->where('status',1);

        return view('health_condition.index')->with('hc',$hc);

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
        $hc = new HealthCondition;
        $hc->health_condition = $request->health_condition;
        $hc->status = 1;
        $hc->save();

        $hc = HealthCondition::all()->where('status',1);

        return view('health_condition.index')->with('hc',$hc);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\HealthCondition  $healthCondition
     * @return \Illuminate\Http\Response
     */
    public function show(HealthCondition $healthCondition)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\HealthCondition  $healthCondition
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $hc = HealthCondition::findorFail($id);
        return view('health_condition.edit')->with('hc',$hc);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\HealthCondition  $healthCondition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $hc = HealthCondition::findorFail($id);
        $hc->health_condition = $request->health_condition;
        $hc->update();

        $hc = HealthCondition::all()->where('status',1);

        return view('health_condition.index')->with('hc',$hc);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\HealthCondition  $healthCondition
     * @return \Illuminate\Http\Response
     */
    public function destroy(HealthCondition $healthCondition)
    {
        //
    }
}
