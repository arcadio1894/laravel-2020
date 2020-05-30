<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['name', 'description', 'subject_id', 'image'];

    public function course()
    {
        return $this->belongsTo('App\Course');
    }

    public function contents()
    {
        return $this->hasMany('App\Content');
    }
}
