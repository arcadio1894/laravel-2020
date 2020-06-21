<?php

namespace App\Events;

use App\Course;
use App\Teacher;
use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CourseAssigned
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $course;
    public $user;
    public $teacher;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct( Course $course, User $user, Teacher $teacher )
    {
        $this->course = $course;
        $this->user = $user;
        $this->teacher = $teacher;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
