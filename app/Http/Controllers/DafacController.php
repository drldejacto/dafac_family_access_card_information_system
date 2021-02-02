<?php

namespace App\Http\Controllers;

use App\Provinces;
use App\Barangay;
use App\Dafac;
use App\Disaster;
use App\Roster;
use App\EvacSite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DafacController extends Controller
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
         if (Auth::check())
        {
             $encoded_by = Auth::user()->id;
        }
        //$roster = Roster::all()->where('status',1)->where('relationship_to_hh_head',1)
        if(Auth::user()->is_admin==1){
         /** $dafac = DB::table('dafac_master_file as dafac')
            ->leftjoin('tbl_family_roster as ros', 'dafac.id', '=', 'ros.serial_no')
            ->leftjoin('lib_provinces as lp','lp.prov_code','=','dafac.prov_code')
            ->leftjoin('lib_cities as city','city.city_code','=','dafac.city_code')
            ->leftjoin('lib_brgy as lb','lb.brgy_code','=','dafac.brgy_code')
            ->leftjoin('evac_site as ec','ec.id','evac_site_id')
            ->leftjoin('users','users.id','=','dafac.encoded_by')
            ->select('dafac.*', 'ros.*','lp.prov_name','city_name','brgy_name','evacuation_site','last_name','first_name','middle_name','date_registered','name')
            ->where('dafac.status','=',1)
            ->where('ros.status','=',1)
            ->where('ros.relationship_to_hh_head',1)
            ->orderBy('dafac.created_at','desc')
            ->get();
        **/
             $dafac = DB::table('dafac_master_file as dafac')
            ->leftjoin('lib_provinces as lp','lp.prov_code','=','dafac.prov_code')
            ->leftjoin('lib_cities as city','city.city_code','=','dafac.city_code')
            ->leftjoin('lib_brgy as lb','lb.brgy_code','=','dafac.brgy_code')
            ->leftjoin('evac_site as ec','ec.id','evac_site_id')
            ->leftjoin('users','users.id','=','dafac.encoded_by')
            ->leftjoin(DB::raw('(SELECT serial_no, last_name, first_name, middle_name FROM tbl_family_roster  WHERE status = 1 and relationship_to_hh_head = 1) as ros'), function($join){
                $join->on('dafac.id','=','ros.serial_no');
            })
            ->select('dafac.*','lp.prov_name','city_name','brgy_name','evacuation_site','last_name','first_name','middle_name','date_registered','name')
            ->where('dafac.status','=',1)
            ->orderBy('dafac.created_at','desc')
            ->get();
            
        }else{

            $dafac = DB::table('dafac_master_file as dafac')
            ->leftjoin('lib_provinces as lp','lp.prov_code','=','dafac.prov_code')
            ->leftjoin('lib_cities as city','city.city_code','=','dafac.city_code')
            ->leftjoin('lib_brgy as lb','lb.brgy_code','=','dafac.brgy_code')
            ->leftjoin('evac_site as ec','ec.id','evac_site_id')
            ->leftjoin('users','users.id','=','dafac.encoded_by')
            ->leftjoin(DB::raw('(SELECT serial_no, last_name, first_name, middle_name FROM tbl_family_roster  WHERE status = 1 and relationship_to_hh_head = 1) as ros'), function($join){
                $join->on('dafac.id','=','ros.serial_no');
            })
            ->select('dafac.*','lp.prov_name','city_name','brgy_name','evacuation_site','last_name','first_name','middle_name','date_registered','name')
            ->where('dafac.status','=',1)
            ->where('encoded_by','=',$encoded_by)
            ->orderBy('dafac.created_at','desc')
            ->get();
        }
        //$hh_head = Roster::all()->where('relationship_to_hh_head','1')->where('status',1);


        return view('dafac.index')->with('dafac',$dafac);
        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $province = Provinces::all()->where('status',1);
        $brgy = Barangay::all()->where('city_code','072234000');
        $evacSite = EvacSite::all()->where('status',1);
        return view('dafac.create')->with('province',$province)->with('brgys',$brgy)->with('evacSite',$evacSite);
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
        if (Auth::check())
        {
             $encoded_by = Auth::user()->id;
        }

        $counter = Dafac::count();
        $counter   = $counter + 1;
        $disaster = Disaster::findOrFail(1);
        $code = $disaster->code;
        $dafac = new Dafac();
        $dafac_serial_no = $code . '-' . $counter;
        $dafac->id = $dafac_serial_no;
        $dafac->disaster_id = $disaster->id;
        $dafac->prov_code = $request->prov_code;
        $dafac->city_code = $request->city_code;
        $dafac->brgy_code = $request->brgy_code;
        $dafac->evac_site = $request->evac_site;
        $dafac->tenure_status = $request->tenure_status;
        $dafac->housing_condition = $request->housing_condition;
        $dafac->date_registered = $request->date_registered;
        $dafac->name_of_brgy_captain = $request->name_of_brgy_captain;
        $dafac->name_of_lswdo = $request->name_of_lswdo;
        $dafac->pantawid = $request->pantawid;
        $dafac->is_indigenous = $request->is_indigenous;
        $dafac->type_of_ip = $request->type_of_ip;
        $dafac->status = 1;
        $dafac->encoded_by= $encoded_by;
        $dafac->evacuation_status = $request->evacuation_status;
        $dafac->evac_site_id = $request->evac_site;
        $dafac->is_affected = $request->is_affected;
        $dafac->save();

        Session::flash('success', 'You have successfully added a record.');

        return redirect()->route('dafac.show',$dafac_serial_no);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Dafac  $dafac
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
       
        $dafac = DAFAC::findOrFail($id);
        return view('dafac.show')->with('dafac',$dafac);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Dafac  $dafac
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
         $brgy = Barangay::all()->where('city_code','072234000');
        $dafac = DAFAC::findOrFail($id);
        $evacSite = EvacSite::all()->where('status',1);
        return view('dafac.edit')->with('dafac',$dafac)->with('brgys',$brgy)->with('evacSite',$evacSite);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Dafac  $dafac
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        if (Auth::check())
        {
             $encoded_by = Auth::user()->id;
        }
        $dafac = DAFAC::findOrFail($id);
        $dafac->prov_code = $request->prov_code;
        $dafac->city_code = $request->city_code;
        $dafac->brgy_code = $request->brgy_code;
        $dafac->evac_site = $request->evac_site;
        $dafac->tenure_status = $request->tenure_status;
        $dafac->housing_condition = $request->housing_condition;
        $dafac->date_registered = $request->date_registered;
        $dafac->name_of_brgy_captain = $request->name_of_brgy_captain;
        $dafac->name_of_lswdo = $request->name_of_lswdo;
        $dafac->pantawid = $request->pantawid;
        $dafac->is_indigenous = $request->is_indigenous;
        $dafac->type_of_ip = $request->type_of_ip;
        $dafac->encoded_by= $encoded_by;
        $dafac->evacuation_status = $request->evacuation_status;
        $dafac->evac_site_id = $request->evac_site;
        $dafac->is_affected = $request->is_affected;
        $dafac->update();

        Session::flash('edit_success', 'You have successfully edited a record.');

        return redirect()->route('dafac.show',$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dafac  $dafac
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dafac $dafac)
    {
        //
    }
    public function deleteDafac($id){
        

        $roscount = Roster::where('serial_no',$id)->where('status',1)->count();
        if($roscount > 0){
          Roster::where('serial_no', '=', $id)->update(['status' => 1]);
        }
        $dafac = Dafac::findorfail($id);
        $dafac->status = 2;
        $dafac->update();
        $dafac = Dafac::all()->where('status',1);

        return redirect()->route('dafac.index');
    }
    public function searchDafac(){

        return view('dafac.searchDafac');
    }

    public function search(Request $request) {

        $request->get('search');
        $dafac = Dafac::findorFail($request)->where('status',1);

        if (empty($dafac)) {
            Session::flash('delete_success', 'Serial Number not found.');
            return view('dafac.searchDafac');
        }else{
            return view('dafac.show')->with('dafac',$dafac);
        }      

    }
}
