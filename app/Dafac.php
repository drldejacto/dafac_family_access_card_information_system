<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dafac extends Model
{
    //
    protected $fillable = [
        'id' , 'disaster_id', 'prov_code', 'city_code', 'brgy_code', 'evac_site', 'tenure_status', 'housing_condition', 'date_registered', 'name_of_brgy_captain', 'name_of_lswdo', 'name_of_brgy_captain', 'is_indigenous', 'type_of_ip', 'status'
    ];

    protected $table ='dafac_master_file';

    public function province(){
    	return $this->belongsTo('App\Provinces','prov_code','prov_code');
    }

    public function city(){
    	return $this->belongsTo('App\Cities','city_code','city_code');
    }

    public function barangay(){
    	return $this->belongsTo('App\Barangay','brgy_code','brgy_code');
    }

    public function encoder(){
    	return $this->belongsTo('App\User','encoded_by','id');
    }
    public function rosters(){
        return $this->hasMany('App\Roster','serial_no','id');
    }
    public function evacSite(){
        return $this->belongsTo('App\EvacSite','evac_site_id','id');
    }

}
