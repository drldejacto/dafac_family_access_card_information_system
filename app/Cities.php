<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    //

    protected $fillable = [
        'prov_code' , 'city_name', 'city_code', 'status'
    ];

    protected $table ='lib_cities';
}
