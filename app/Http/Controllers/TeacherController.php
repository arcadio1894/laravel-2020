<?php

namespace App\Http\Controllers;

use App\CourseTeacher;
use App\Http\Requests\UpdateTeacher;
use App\Http\Requests\StoreTeacher;
use App\Http\Requests\DeleteTeacher;
use App\Teacher;
use App\User;
use App\Course;
use Illuminate\Http\Request;
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

    
    public function edit($id)
    {
        $teachers = Teacher::find($id);
        return $teachers;
    }

    
    public function update(UpdateTeacher $request)
    {
        // Actualizar Teacher
        $teacher = Teacher::find($request->get('id'));
        $teacher->name = $request->get('name');
        $teacher->speciality = $request->get('speciality');
        $teacher->years = $request->get('years');
        $teacher->country = $request->get('country');
        $teacher->phone = $request->get('phone');
        $teacher->save();

        if ($request->file('image'))
        {
            $path = public_path().'/images/teachers/';
            $extension = $request->file('image')->getClientOriginalExtension();
            $filename = $teacher->id . '.' . $extension;
            $request->file('image')->move($path, $filename);
            $teacher->image = $filename;
            $teacher->save();
        }

    }

    
    public function destroy(DeleteTeacher $request, $id)
    {

        $teacher = Teacher::findOrFail($id);
        $teacher->courses()->where('id',$id)->detach();
        $teacher->delete();

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
}
