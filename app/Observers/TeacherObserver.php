<?php

namespace App\Observers;

use App\Mail\TeacherCreatedSent;
use App\Teacher;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class TeacherObserver
{
    /**
     * Handle the teacher "created" event.
     *
     * @param  \App\Teacher  $teacher
     * @return void
     */
    public function created(Teacher $teacher)
    {
        $user = User::where('id', Auth::user()->id)->first();
        Mail::to('joryes1894@gmail.com')
            ->send(new TeacherCreatedSent($teacher, $user));
    }

    /**
     * Handle the teacher "updated" event.
     *
     * @param  \App\Teacher  $teacher
     * @return void
     */
    public function updated(Teacher $teacher)
    {
        //
    }

    /**
     * Handle the teacher "deleted" event.
     *
     * @param  \App\Teacher  $teacher
     * @return void
     */
    public function deleted(Teacher $teacher)
    {
        //
    }

    /**
     * Handle the teacher "restored" event.
     *
     * @param  \App\Teacher  $teacher
     * @return void
     */
    public function restored(Teacher $teacher)
    {
        //
    }

    /**
     * Handle the teacher "force deleted" event.
     *
     * @param  \App\Teacher  $teacher
     * @return void
     */
    public function forceDeleted(Teacher $teacher)
    {
        //
    }
}
