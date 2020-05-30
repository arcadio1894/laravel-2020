<?php

namespace App\Http\Controllers;

use App\CourseTeacher;
use App\Http\Requests\StoreTeacher;
use App\Teacher;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::paginate(5);
        return view('teachers.index', compact('teachers'));
    }


    public function create()
    {
        //
    }

    public function store(StoreTeacher $request)
    {
        $validated = $request->validated();

        if (!$request->validator->fails()){
            // Guardar al usuario
            $user = User::create([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => Hash::make('password'),
            ]);
            // Guardar el profesor
            $teacher = Teacher::create([
                'name' => $request->get('name'),
                'speciality' => $request->get('speciality'),
                'years' => $request->get('years'),
                'country' => $request->get('country'),
                'phone' => $request->get('phone'),
                'user_id' => $user->id,
            ]);

            if (!$request->file('image'))
            {
                $teacher->image = 'no_image.jpg';
            }else{
                $path = public_path().'/images/teachers/';
                $extension = $request->file('image')->getClientOriginalExtension();
                $filename = $teacher->id . '.' . $extension;
                $request->file('image')->move($path, $filename);
                $teacher->image = $filename;
                $teacher->save();
            }

        }

        return response()->json($request->validator->messages(),200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $teacher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {

    }

    public function getAll()
    {
        $teachers = Teacher::pluck('name')->toArray();

        return $teachers;
    }

    public function getTeachers($idCourse)
    {
        $teachers = Teacher::get(['id','name']);

        $teachersSelected = CourseTeacher::where('course_id', $idCourse)->pluck('teacher_id')->toArray();

        return (array('teachers'=>$teachers,'teachersSelected'=>$teachersSelected));
    }

    public function showCourse()
    {
        $user_teacher = User::where('id', Auth::user()->id)->with('teachers')->get();
        //dd(isset($user_teacher[0]));
        if (isset($user_teacher[0]))
            $courses = Teacher::find($user_teacher[0]->teachers[0]->id)->with('courses')->get();
        else
            $courses = null;
        //dd($courses);
        return view('teachers.showCourse', compact('courses'));
    }

    // Uso de Carbon
    public function carbon()
    {
        $carbon = Carbon::now( 'America/Vancouver' );
        var_dump($carbon);

        $string = $carbon->isoFormat('dddd D');
        var_dump($string);

        $create = Carbon::create(2020, 5, 23, 10, 44, 0);
        var_dump($create);

        $add = $carbon->add('month', 1);
        var_dump($add);

        $diff = $add->diffInYears($create);
        var_dump($diff);

        $carbon2 = new Carbon('Europe/London');
        var_dump($carbon2);

        $carbon3 = Carbon::now('+13:30');
        var_dump($carbon3->tzName);

        $today = Carbon::today();
        var_dump($today);
        $yesterday = Carbon::yesterday();
        var_dump($yesterday);
        $tomorrow = Carbon::tomorrow();
        var_dump($tomorrow);

        echo Carbon::create(2000, 1, 35, 13, 0, 0);

        echo "\n";

        try {
            Carbon::createSafe(2000, 1, 35, 13, 0, 0);
        } catch (\Carbon\Exceptions\InvalidDateException $exp) {
            echo $exp->getMessage();
        }

        $teacher = Teacher::where('id', 1)->get();

        $date = $teacher[0]->updated_at;
        //dd($date->diffForHumans());


        $userTimezone = 'America/Lima';
        $userLanguage = 'es_ES';

        Carbon::macro('formatForUser', static function () use ($userTimezone, $userLanguage) {
            $date = self::this()->copy()->tz($userTimezone)->locale($userLanguage);

            return $date->calendar(); // or ->isoFormat($customFormat), ->diffForHumans(), etc.
        });

        echo Carbon::parse($date, 'America/Lima')->formatForUser();   // 23/01/2010
        echo "\n";
        echo Carbon::tomorrow()->formatForUser();                  // Demain à 02:00
        echo "\n";
        echo Carbon::now()->subDays(3)->formatForUser();

        $date = $date->locale('es_ES');
        echo $date->diffForHumans();


    }
}
