<?php

namespace App\Exports;

use App\Teacher;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TeacherExport implements FromView
{

    public function view(): View
    {
        return view('exports.teachersEXCEL', [
            'teachers' => Teacher::with('courses')->get(),
            'date' => Carbon::now()
        ]);
    }
}
