<?php

namespace App\Mail;

use App\Teacher;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TeacherCreatedSent extends Mailable
{
    use Queueable, SerializesModels;

    public $teacher;
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( Teacher $teacher, User $user )
    {
        $this->user = $user;
        $this->teacher = $teacher;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.teacherCreated')
            ->subject('Creación de profesor');
    }
}
