<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VistaCourses extends Model
{
    protected $table = 'vista_courses';

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = false;


}
