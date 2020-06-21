<?php

namespace App\Listeners;

use App\Events\CourseCreated;
use App\Mail\CourseCreatedSent;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SendCourseCreatedNotification
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
     * @param  CourseCreated  $event
     * @return void
     */
    public function handle(CourseCreated $event)
    {
        $user = User::where('id', Auth::user()->id)->first();
        $course = $event->course;
        Mail::to('joryes1894@gmail.com')
            ->send(new CourseCreatedSent($course, $user));
    }
}
