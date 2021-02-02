<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use HousingCondition;
use Dafac;
use DB;


class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
       $housing_condition = DB::table('dafac_master_file as dafac')
            ->join('lib_brgy as lb','lb.brgy_code','=','dafac.brgy_code')
            ->join('lib_housing_condition as lh','lh.id','=','dafac.housing_condition')
            ->select('brgy_name',DB::raw('SUM(CASE WHEN dafac.housing_condition = 1  THEN 1 ELSE 0 END) as partially_damage'), DB::raw('SUM(CASE WHEN dafac.housing_condition = 2 THEN 1 ELSE 0 END) as totally_damage'), DB::raw('SUM(CASE WHEN dafac.housing_condition = 3 THEN 1 ELSE 0 END) as no_damage'), DB::raw('SUM(CASE WHEN dafac.housing_condition = 0 THEN 1 ELSE 0 END) as no_data'))
            ->where('dafac.status',1)
            ->groupBy('brgy_name')
            ->get();

        return view('dashboard', compact('housing_condition'));
    }

     public function reportHousingCondition()
    {
        //    
       $housing_condition = DB::table('dafac_master_file as dafac')
            ->join('lib_brgy as lb','lb.brgy_code','=','dafac.brgy_code')
            ->join('lib_housing_condition as lh','lh.id','=','dafac.housing_condition')
            ->select('brgy_name',DB::raw('SUM(CASE WHEN dafac.housing_condition = 1  THEN 1 ELSE 0 END) as partially_damage'), DB::raw('SUM(CASE WHEN dafac.housing_condition = 2 THEN 1 ELSE 0 END) as totally_damage'), DB::raw('SUM(CASE WHEN dafac.housing_condition = 3 THEN 1 ELSE 0 END) as no_damage'), DB::raw('SUM(CASE WHEN dafac.housing_condition = 0 THEN 1 ELSE 0 END) as no_data'))
            ->where('dafac.status',1)
            ->groupBy('brgy_name')
            ->get();

        return view('report_housing_condition', compact('housing_condition'));
    }

    public function reportVulSector(){

        $sector = DB::table('dafac_master_file as dafac')
            ->join('lib_brgy as lb','lb.brgy_code','=','dafac.brgy_code')
            ->join('tbl_family_roster as ros', 'ros.serial_no', '=', 'dafac.id')
            ->join('lib_vulnerability as vul','vul.id','=','ros.vulnerability')
            ->select('brgy_name',DB::raw('SUM(CASE WHEN ros.vulnerability = 1  THEN 1 ELSE 0 END) as older_person'), DB::raw('SUM(CASE WHEN ros.vulnerability = 2 THEN 1 ELSE 0 END) as lactating_mother'), DB::raw('SUM(CASE WHEN ros.vulnerability = 3 THEN 1 ELSE 0 END) as pwd'),DB::raw('SUM(CASE WHEN ros.vulnerability = 4 THEN 1 ELSE 0 END) as pregnant'), DB::raw('SUM(CASE WHEN ros.vulnerability = 3 THEN 1 ELSE 0 END) as solo_parent'))
            ->where('dafac.status',1)
            ->where('ros.status',1)
            ->groupBy('brgy_name')
            ->get();

         return view('report_vulnerable_sector', compact('sector'));
    }

    public function reportDisIndividual(){

         $individual = DB::table('dafac_master_file as dafac')
            ->join('lib_brgy as lb','lb.brgy_code','=','dafac.brgy_code')
            ->join('tbl_family_roster as ros', 'ros.serial_no', '=', 'dafac.id')
            ->select('brgy_name',DB::raw('SUM(CASE WHEN ros.gender = 1  THEN 1 ELSE 0 END) as male'), DB::raw('SUM(CASE WHEN ros.gender = 2 THEN 1 ELSE 0 END) as female'))
            ->where('dafac.status',1)
            ->where('ros.status',1)
            ->groupBy('brgy_name')
            ->get();

        return view('report_displaced_individual', compact('individual'));
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
