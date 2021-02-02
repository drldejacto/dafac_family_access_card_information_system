<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barangay extends Model
{
    //
     protected $fillable = [
        'brgy_code' , 'brgy_name', 'city_code', 'status'
    ];

    protected $table ='lib_brgy';
}
