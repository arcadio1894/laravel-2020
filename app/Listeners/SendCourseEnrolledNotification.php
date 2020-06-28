<?php

namespace App\Listeners;

use App\Events\CourseEnrolled;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendCourseEnrolledNotification
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
     * @param  CourseEnrolled  $event
     * @return void
     */
    public function handle(CourseEnrolled $event)
    {
        //
    }
}
