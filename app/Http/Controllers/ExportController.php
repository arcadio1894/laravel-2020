<?php

namespace App\Http\Controllers;

use App\Course;

use App\Exports\CourseExport;
use App\Exports\TeacherExport;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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
        $course = Course::where('id', $id)->with('teachers')->get();
        $date = Carbon::now();
        $vista = view('exports.coursePDF', compact('course', 'date'));
        $pdf = PDF::loadHTML($vista);
        return $pdf->stream();
    }

    public function exportCoursesEXCEL()
    {
        return Excel::download(new CourseExport(), 'cursos.xlsx');
    }

    public function exportTeachersEXCEL()
    {
        return Excel::download(new TeacherExport(), 'profesores.xlsx');
    }
}
