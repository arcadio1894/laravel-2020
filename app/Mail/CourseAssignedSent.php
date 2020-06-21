<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CourseAssignedSent extends Mailable
{
    use Queueable, SerializesModels;

    public $NameTeacher;
    public $NameCourse;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($NameTeacher, $NameCourse)
    {
        $this->NameTeacher = $NameTeacher;
        $this->NameCourse = $NameCourse;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.courseAssigned')
            ->subject('Asignación de cursos');
    }
}
