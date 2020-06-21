<?php

namespace App\Listeners;

use App\Events\CourseDeleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendCourseDeletedNotification
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
     * @param  CourseDeleted  $event
     * @return void
     */
    public function handle(CourseDeleted $event)
    {
        //
    }
}
