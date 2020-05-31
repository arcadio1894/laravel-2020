<?php

namespace App\Http\Controllers;

use App\Course;

use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function exportCoursesPDF()
    {
        // TODO: Exporta todos los cursos
        $courses = Course::with('teachers')->get();
        $date = Carbon::now();
        $vista = view('exports.coursesPDF', compact('courses', 'date'));
        $pdf = PDF::loadHTML($vista);
        return $pdf->stream();
    }

    public function exportCoursePDF( $id )
    {
        // TODO: Exporta solo un curso específico
    }
}
