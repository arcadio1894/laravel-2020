<?php

namespace App\Http\Controllers;

use App\Course;
use App\Events\CourseEnrolled;
use App\Mail\EmailTeacherSent;
use App\Mail\MessageContactSent;
use App\Teacher;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class EmailController extends Controller
{
    public function getcontact()
    {
        // Devolver la vista
        return view('contact.contact');
    }

    public function sendcontact( Request $request )
    {
        // TODO: Enviar el correo
        $fullname = $request->get('fname') . ' ' . $request->get('lname');
        $email = $request->get('eaddress');
        $tel = $request->get('tel');
        $message = $request->get('message');
        //dd($fullname);

        Mail::to('mailpruebacursophp@gmail.com')
            ->send(new MessageContactSent($fullname, $email, $tel, $message));
        return Redirect::to('/');
    }

    public function sendEmailTeacher( Request $request ){
        //dd( $request );
        $rules = array(
            'mensaje' => 'string|max:255',
        );
        $mensajes = array(
            'mensaje.string' => 'El mensaje debe contener solo caracteres',
            'mensaje.max' => 'El mensaje debe contener 255 caracteres como maximo',

        );
        $mensaje = $request->get('mensaje');
        $teacher = Teacher::where('id',$request->get('teacher_id'))->first();
        $user = User::where('id',$teacher->user_id)->first();
        //dd($user);
        $path = public_path().'/pdfs/';
        $extension = $request->file('archivo')->getClientOriginalExtension();
        $filename = $teacher->id . '.' . $extension;
        $request->file('archivo')->move($path, $filename);

        $validator = Validator::make($request->all(), $rules, $mensajes);

        Mail::to($user->email)
            ->send(new EmailTeacherSent($user, $teacher, $filename, $mensaje));

        return response()->json($validator->messages(),200);
    }

    public function sendCourseEnrolled($course_id)
    {
        $course = Course::where('id', $course_id)->first();
        $user = User::where('id', Auth::user()->id)->first();
        //dd($user);
        event( new CourseEnrolled($course, $user));

        return redirect()->route('landing.courses');
    }

    public function listenCourseEnrolled()
    {
        return view('mails.listenEnrolled');
    }

}
