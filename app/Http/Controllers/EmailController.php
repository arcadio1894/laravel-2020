<?php

namespace App\Http\Controllers;

use App\Mail\MessageContactSent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
    }
}
