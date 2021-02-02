<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Relationship extends Model
{
    //
    protected $fillable = [
        'id' , 'relationship_to_head', 'status'
    ];

    protected $table ='relationship_to_hh_head';
}
