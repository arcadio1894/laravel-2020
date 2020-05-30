<?php

use Illuminate\Database\Seeder;
use App\Course;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Course::create([
            'name'          => 'Laravel 7',
            'description'   => 'Curso de desarrollo de paginas web usando Laravel',
            'image'         => '1.jpg',
            'price'         => 500.00,
            'stars'         => 4,
            'hours'         => 'Sab y Dom 10am a 12pm',
            'active'        => 1
        ]);
        factory(App\Course::class, 10)->create();
    }
}
