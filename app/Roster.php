<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roster extends Model
{
    //
     protected $fillable = [
        'id' , 'serial_no' , 'first_name', 'middle_name', 'last_name', 'relationship_to_hh_head', 'birthday', 'age_in_years', 'age_in_months', 'gender', 'educ_attain', 'occupational_skills', 'monthly_income', 'health_condition', 'vulnerability', 'status'
    ];

    protected $table ='tbl_family_roster';

    public function rel_to_hh(){
    	return $this->belongsTo('App\Relationship','relationship_to_hh_head','id');
	}
	public function education(){
    	return $this->belongsTo('App\Education','educ_attain','id');
	}

    public function dafacRoster(){
        return $this->belongsTo('App\Dafac','serial_no','id');
    }

    public function rosterVulnerability(){
        return $this->belongsTo('App\Vulnerability','vulnerability','id');
    }

    public function rosterHealthCondition(){
        return $this->belongsTo('App\HealthCondition','health_condition','id');
    }
}

