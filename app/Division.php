<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Division extends Model
{
    use SoftDeletes;

    public $table = 'division';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'description',
        'status',
        'supervisor_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function supervisor()
    {
        return $this->belongsTo(User::class,'supervisor_id', 'id');
    }

}
