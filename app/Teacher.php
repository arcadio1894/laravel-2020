<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = ['name', 'speciality', 'years', 'country', 'phone', 'image', 'user_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function courses()
    {
        return $this->belongsToMany('App\Course', 'course_teachers')->withPivot('course_id');
    }


}
