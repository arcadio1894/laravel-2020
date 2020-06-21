<?php

namespace App\Mail;

use App\Teacher;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailTeacherSent extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $teacher;
    public $archivo;
    public $mensaje;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( User $user, Teacher $teacher, $archivo, $mensaje )
    {
        $this->user = $user;
        $this->teacher = $teacher;
        $this->archivo = $archivo;
        $this->mensaje = $mensaje;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.teacher')
            ->subject('Temario de cursos')
            ->attach(public_path().'/pdfs/'.$this->archivo, [
                'as' => 'temario.pdf',
                'mime' => 'application/pdf',
            ]);
    }
}
