<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provinces extends Model
{
    //
     protected $fillable = [
        'prov_code' , 'prov_name', 'status'
    ];

    protected $table ='lib_provinces';
}
