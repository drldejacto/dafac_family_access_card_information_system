<?php

namespace App\Http\Controllers;

use App\Roster;
use App\Relationship;
use App\Education;
use App\Dafac;
use App\HealthCondition;
use App\Vulnerability;
use Illuminate\Http\Request;

class RosterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        $relationships = Relationship::all()->where('status',1);
        $rosters = Roster::all()->where('id',$id)->where('status',1);
        $educ_attain = Education::all()->where('status',1);
        $dafac = Dafac::findorFail($id);
        return view('roster.index')->with('rosters',$rosters)->with('relationships',$relationships)->with('education',$educ_attain)->with('dafac',$dafac); 
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
        $roster = new Roster();
        $roster->serial_no = $request->serial_no;
        $roster->first_name = $request->first_name;
        $roster->last_name = $request->last_name;
        $roster->middle_name = $request->middle_name;
        $roster->relationship_to_hh_head = $request->relationship_to_hh_head;
        $roster->birthday = $request->birthday;
        $roster->age_in_years = $request->age_in_years;
        $roster->age_in_months = $request->age_in_months;
        $roster->gender  = $request->gender;
        $roster->educ_attain = $request->educ_attain;
        $roster->occupational_skills = $request->occupational_skills;
        $roster->monthly_net_income = $request->monthly_net_income;
        $roster->health_condition = $request->health_condition;
        $roster->vulnerability = $request->vulnerability;
        $roster->status  = 1;
        $roster->save();

        return redirect()->route('roster.show',$roster->serial_no);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Roster  $roster
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $relationships = Relationship::all()->where('status',1);
        $rosters = Roster::all()->where('serial_no',$id)->where('status',1);
        $educ_attain = Education::all()->where('status',1);
        $dafac = Dafac::findorFail($id);
        return view('roster.index')->with('rosters',$rosters)->with('relationships',$relationships)->with('education',$educ_attain)->with('dafac',$dafac); 
    }

    public function viewProfile($id){
        $roster = Roster::findorFail($id);
        $educ_attain = Education::all()->where('status',1);
        $relationships = Relationship::all()->where('status',1);

        return view('roster.viewProfile')->with('roster',$roster)->with('relationships',$relationships)->with('education',$educ_attain);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Roster  $roster
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $education = Education::all()->where('status',1);
        $relationships  = Relationship::all()->where('status',1);
        $roster = Roster::findorFail($id);
        $hc = HealthCondition::all()->where('status',1);
        $vul = Vulnerability::all()->where('status',1);
        return view('roster.edit')->with('roster',$roster)->with('relationships',$relationships)->with('education',$education)->with('hc',$hc)->with('vul',$vul);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Roster  $roster
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        

        $roster = Roster::findOrFail($id);       
        $roster->first_name = $request->first_name;
        $roster->last_name = $request->last_name;
        $roster->middle_name = $request->middle_name;
        $roster->relationship_to_hh_head = $request->relationship_to_hh_head;
        $roster->birthday = $request->birthday;
        $roster->age_in_years = $request->age_in_years;
        $roster->age_in_months = $request->age_in_months;
        $roster->gender  = $request->gender;
        $roster->educ_attain = $request->educ_attain;
        $roster->occupational_skills = $request->occupational_skills;
        $roster->monthly_net_income = $request->monthly_net_income;
        $roster->health_condition = $request->health_condition;
        $roster->vulnerability = $request->vulnerability;
        $roster->status  = 1;
        $roster->update();

        return redirect()->route('roster.viewProfile',$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Roster  $roster
     * @return \Illuminate\Http\Response
     */
    public function destroy(Roster $roster)
    {
        //
    }

    public function deleteRoster($id){
        $roster = Roster::findorfail($id);
        $serial_no = $roster->serial_no;
        $roster->status = 2;
        $roster->update();
        $roster = Roster::all()->where('status',1);

        $relationships = Relationship::all()->where('status',1);
        $rosters = Roster::all()->where('serial_no',$serial_no)->where('status',1);
        $educ_attain = Education::all()->where('status',1);
        //$dafac = Dafac::findorFail($id);

        return redirect()->route('roster.show',$serial_no)->with('relationships',$relationships)->with('rosters',$rosters)->with('educ_attain',$educ_attain);

    }
}
