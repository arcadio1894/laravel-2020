<?php

use Illuminate\Database\Seeder;
use App\Teacher;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Teacher::create([
            'name'		    => 'Jorge Gonzales Castillo',
            'speciality'  	=> 'Backend',
            'years' 	    => 4,
            'country'       => 'Peru',
            'phone'         => '966514574',
            'user_id'       => 2
        ]);
    }
}
