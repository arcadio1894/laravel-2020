<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'description', 'image', 'price', 'stars', 'hours', 'active'];

    // TODO: Colocar las relaciones ...
    public function teachers()
    {
        return $this->belongsToMany('App\Teacher', 'course_teachers')->withPivot('teacher_id');
    }

    public function subjects()
    {
        return $this->hasMany('App\Subject');
    }

    public function getUpdateHumansAttribute()
    {
        $date = $this->updated_at->locale('es_ES');
        return $date->diffForHumans();
    }

    protected $dates = ['delete_at'];
}
