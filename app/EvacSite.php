<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EvacSite extends Model
{
     protected $fillable = [
        'evacuation_site', 'status'
    ];

    protected $table ='evac_site';
}
