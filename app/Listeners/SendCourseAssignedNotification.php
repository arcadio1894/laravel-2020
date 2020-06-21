<?php

namespace App\Listeners;

use App\Events\CourseAssigned;
use App\Mail\CourseAssignedSent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendCourseAssignedNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CourseAssigned  $event
     * @return void
     */
    public function handle(CourseAssigned $event)
    {
        $email = $event->user->email;
        $NameTeacher = $event->teacher->name;
        $NameCourse = $event->course->name;
        Mail::to($email)
            ->send(new CourseAssignedSent($NameTeacher, $NameCourse));
    }
}
