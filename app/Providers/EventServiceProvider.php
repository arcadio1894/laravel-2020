<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        'App\Events\CourseAssigned' => [
            'App\Listeners\SendCourseAssignedNotification',
        ],
        'App\Events\CourseCreated' => [
            'App\Listeners\SendCourseCreatedNotification',
        ],
        'App\Events\CourseDeleted' => [
            'App\Listeners\SendCourseDeletedNotification',
        ],

        'App\Events\CourseEnrolled' => [
            'App\Listeners\SendCourseEnrolledNotification',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
