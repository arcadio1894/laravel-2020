<?php

namespace App\Mail;

use App\Course;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CourseCreatedSent extends Mailable
{
    use Queueable, SerializesModels;

    public $course;
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( Course $course, User $user )
    {
        $this->course = $course;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.courseCreated');
    }
}
