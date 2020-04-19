<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'description'];

    // TODO: Colocar las relaciones ...

    protected $dates = ['delete_at'];
}
