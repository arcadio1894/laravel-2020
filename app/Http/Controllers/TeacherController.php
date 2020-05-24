<?php

namespace App\Http\Controllers;

use App\CourseTeacher;
use App\Http\Requests\StoreTeacher;
use App\Teacher;
use App\User;
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
    public function update(UpdateTeacher $request)
    {
        $validated = $request->validated();

        if (!$request->validator->fails()){
            $teacher = Teacher::find($request->get('id'));
            $teacher->name =  $request->get('name');
            $teacher->speciality = $request->get('speciality');
            $teacher->years =$request->get('years');
            $teacher->country = $request->get('country');
            $teacher->phone =$request->get('phone');
            $teacher->save();

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
     * Remove the specified resource from storage.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteTeacher $request,$id)
    {
        $validated = $request->validated();

        if (!$request->validator->fails()){
            $teacher = Teacher::find($id);
            $teacher->delete();
        }

        return response()->json($request->validator->messages(),200);
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
