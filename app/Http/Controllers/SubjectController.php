<?php

namespace App\Http\Controllers;

use App\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function store(Request $request)
    {
        dd($request);
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
                // TODO: Uso de Intervention Image
                $img = Image::make($request->file('image'));
                //dd($img);
                $img->resize(320, 240);
                $marker = Image::make(public_path().'/images/teachers/watermark.png')->resize(320, 240);
                $img->insert($marker);

                $path = public_path().'/images/teachers/';
                $extension = $request->file('image')->getClientOriginalExtension();
                $filename = $teacher->id . '.' . $extension;

                $img->save($path.$filename, 60);
                //$request->file('image')->move($path, $filename);
                $teacher->image = $filename;
                $teacher->save();
            }

        }

        return response()->json($request->validator->messages(),200);
    }

    public function update(Request $request)
    {
        //
    }

    public function destroy( $id )
    {
        //
    }
}
