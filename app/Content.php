<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $fillable = ['description', 'file', 'url', 'subject_id'];

    public function subject()
    {
        $this->belongsTo('App\Subject');
    }
}
