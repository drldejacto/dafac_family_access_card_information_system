<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HousingCondition extends Model
{
    //
    protected $fillable = [
        'housing_condition', 'status'
    ];

    protected $table ='lib_housing_condition';
}
