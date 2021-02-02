<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disaster extends Model
{
    //
     protected $fillable = [
        'name_of_disaster' , 'status', 'code'
    ];

    protected $table ='lib_disaster';
}
