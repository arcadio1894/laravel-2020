<?php

namespace App\Http\Controllers;

use App\Course;
use App\CourseTeacher;
use App\Events\CourseAssigned;
use App\Subject;
use App\Teacher;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::paginate(5);
        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $rules = array(
            'name' => 'required|string|min:5|unique:courses,name',
            'description' => 'string|max:255',
            'price' => 'required|numeric',
            'stars' => 'numeric',
            'hours' => 'required|string',
            'active' => 'required|boolean'
        );
        $mensajes = array(
            'name.required' => 'Es necesario ingresar el nombre del curso',
            'name.string' => 'El nombre del curso debe contener solo caracteres',
            'name.min' => 'El nombre del curso debe contener 5 caracteres como mínimo',
            'name.unique' => 'El curso ya existe en la base de datos',
            'description.string' => 'La descripcion debe contener solo caracteres',
            'description.max' => 'La descripcion debe contener 255 caracteres como maximo',
            'price.required' => 'Es necesario ingresar el precio del curso',
            'price.numeric' => 'El precio del curso debe contener solo numeros',
            'stars.numeric' => 'El precio del curso debe contener solo numeros',
            'active.required' => 'Se debe activar o desactivar el curso',
            'active.boolean' => 'Error en el tipo de dato',
            'hours.required' => 'Es necesario ingresar un horario para el curso',
            'hours.string' => 'El horario no tiene el formato correcto ',
        );

        $validator = Validator::make($request->all(), $rules, $mensajes);

        if (!$request->file('image'))
        {
            $validator->after(function ($validator) {
                $validator->errors()->add('image', 'Es necesario ingresar una imagen para el curso');
            });
        }

        if (!$validator->fails()){
            // Guardar el curso
            $course = Course::create([
                'name' => $request->get('name'),
                'description' => $request->get('description'),
                'price' => $request->get('price'),
                'stars' => $request->get('stars'),
                'hours' => $request->get('hours'),
                'active' => $request->get('active'),
            ]);

            $path = public_path().'/images/courses/';
            $extension = $request->file('image')->getClientOriginalExtension();
            $filename = $course->id . '.' . $extension;
            $request->file('image')->move($path, $filename);
            $course->image = $filename;
            $course->save();
        }

        return response()->json($validator->messages(),200);
    }

    public function show(Course $course)
    {
        //
    }

    public function edit(Course $course)
    {
        //
    }

    public function update(Request $request)
    {
        $rules = array(
            'name' => 'required|string|min:5',
            'description' => 'string|max:255',
            'price' => 'required|numeric',
            'stars' => 'numeric',
            'hours' => 'required|string',
            'active' => 'required|boolean'
        );
        $mensajes = array(
            'name.required' => 'Es necesario ingresar el nombre del curso',
            'name.string' => 'El nombre del curso debe contener solo caracteres',
            'name.min' => 'El nombre del curso debe contener 5 caracteres como mínimo',
            'description.string' => 'La descripcion debe contener solo caracteres',
            'description.max' => 'La descripcion debe contener 255 caracteres como maximo',
            'price.required' => 'Es necesario ingresar el precio del curso',
            'price.numeric' => 'El precio del curso debe contener solo numeros',
            'stars.numeric' => 'La valoracion del curso debe contener solo numeros',
            'active.required' => 'Se debe activar o desactivar el curso',
            'active.boolean' => 'Error en el tipo de dato',
            'hours.required' => 'Es necesario ingresar un horario para el curso',
            'hours.string' => 'El horario no tiene el formato correcto ',
        );

        $validator = Validator::make($request->all(), $rules, $mensajes);

        if (!$validator->fails()){
            // Guardar el curso
            $course = Course::find($request->get('id'));
            $course->name = $request->get('name');
            $course->description = $request->get('description');
            $course->price = $request->get('price');
            $course->stars = $request->get('stars');
            $course->hours = $request->get('hours');
            $course->active = $request->get('active');
            $course->save();

            if ($request->file('image'))
            {
                $path = public_path().'/images/courses/';
                $extension = $request->file('image')->getClientOriginalExtension();
                $filename = $course->id . '.' . $extension;
                $request->file('image')->move($path, $filename);
                $course->image = $filename;
                $course->save();
            }

        }

        return response()->json($validator->messages(),200);
    }

    public function destroy(Request $request, $id)
    {
        $rules = array(
            'id' => 'required|exists:courses,id',
        );

        $mensajes = array(
            'id.required' => 'Es necesario enviar el id del curso',
            'id.exists' => 'El curso no existe en la base de datos',
        );

        $validator = Validator::make($request->all(), $rules, $mensajes);

        if (!$validator->fails()){
            $course = Course::find($id);
            $course->delete();
        }

        return response()->json($validator->messages(),200);
    }

    public function getCourse($id)
    {
        $course = Course::find($id);
        return $course;
    }

    public function assign(Request $request)
    {
        $rules = array(
            'id' => 'required|exists:courses,id',
        );

        $mensajes = array(
            'id.required' => 'Es necesario enviar el id del curso',
            'id.exists' => 'El curso no existe en la base de datos',
        );

        $validator = Validator::make($request->all(), $rules, $mensajes);

        if (!$validator->fails()){
            // TODO: Primero eliminamos todo y luego guardamos todo
            $coursesTeachers = CourseTeacher::where('course_id', $request->get('id'));
            $coursesTeachers->delete();

            foreach ($request->get('teachers') as $teacher)
            {
                $courseTeacher = CourseTeacher::create([
                    'course_id' => $request->get('id'),
                    'teacher_id' => $teacher
                ]);

                // Teacher
                $teacher2 = Teacher::where('id', $teacher)->first();

                // User
                $user = User::where('id', $teacher2->user_id)->first();

                // Course
                $course = Course::where('id', $request->get('id'))->first();

                event(new CourseAssigned($course, $user, $teacher2));
            }

        }

        return response()->json($validator->messages(),200);
    }

    public function subjects( $id )
    {
        $course = Course::where('id', $id)->with('subjects')->first();
        //dd($course);
        return view('subjects.index', compact('course'));
    }

    public function courseAll()
    {
        $courses = Course::all();
        return view('courses.courses', compact('courses'));
    }

    public function courseDetails($id)
    {
        $course = Course::where('id', $id)->with('subjects')->with('teachers')->first();
        //dd($course);
        return view('courses.detail', compact('course'));
    }

    public function admissions()
    {
        return view('admissions.admissions');
    }

    public function about()
    {
        return view('admissions.about');
    }
}
