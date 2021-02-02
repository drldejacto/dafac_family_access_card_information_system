<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HealthCondition extends Model
{
    //
    protected $fillable = [
        'health_condition', 'status'
    ];

    protected $table ='lib_health_condition';
}
