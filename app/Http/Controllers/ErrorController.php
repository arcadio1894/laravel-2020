<?php

namespace App\Http\Controllers;

use App\Course;
use App\Subject;
use Illuminate\Http\Request;

class ErrorController extends Controller
{
    public function error404()
    {
        return view('errors.404');
    }

    public function error405()
    {
        return view('errors.405');
    }

    public function lazy()
    {
        $courses = Course::all();
        //$courses = Course::orderby('id')->paginate();
        //dd($courses);
        return view('loading.lazy', compact('courses'));
    }

    public function eager()
    {
        $courses = Course::with(['teachers' => function($query){
            $query->select('name');
        }])->get();
        //$courses = Course::with('subjects')->orderby('id')->paginate();
        //dd($courses);
        return view('loading.eager', compact('courses'));
    }
}
