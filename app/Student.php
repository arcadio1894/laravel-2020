<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'job', 'birthday', 'user_id'];

    // TODO: Relaciones
    public function user()
    {
        return $this->belongsTo('App/User');
    }

    protected $dates = ['deleted_at'];
}
