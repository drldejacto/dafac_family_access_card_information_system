<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Health_Condition extends Model
{
    //
    protected $fillable = [
        'id' , 'educ_attain', 'status'
    ];

    protected $table ='educ_attain';
}
