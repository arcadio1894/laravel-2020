<?php

use Illuminate\Database\Seeder;
use App\Student;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Student::create([
            'name'		    => 'Juan Perez Perez',
            'job'  	        => 'Estudiante Universitario',
            'birthday' 	    => \Carbon\Carbon::create(1996, 05, 12, 0,0,0),
            'user_id'       => 3
        ]);
    }
}
