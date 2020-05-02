<?php

namespace App\Http\Controllers;

use App\Course;
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
                'description' => $request->get('name'),
                'price' => $request->get('name'),
                'stars' => $request->get('name'),
                'hours' => $request->get('name'),
                'active' => $request->get('name'),
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

    public function update(Request $request, Course $course)
    {
        //
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
}
