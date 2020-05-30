<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Role;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // TODO: Rol por defecto
        Role::create([
            'name'		=> 'Admin',
            'slug'  	=> 'admin',
            'description' => 'Rol Administrador',
            'special' 	=> 'all-access'
        ]);

        Role::create([
            'name'		=> 'Teacher',
            'slug'  	=> 'teacher',
            'description' => 'Rol Profesor',
            'special' 	=> null
        ]);

        Role::create([
            'name'		=> 'Student',
            'slug'  	=> 'student',
            'description' => 'Rol Estudiante',
            'special' 	=> null
        ]);

        $user = User::create([
            'name'		=> 'Administrador',
            'email'  	=> 'admin@example.com',
            'password' 	=> bcrypt('123456789')
        ]);

        $user2 = User::create([
            'name'		=> 'Jorge Gonzales Castillo',
            'email'  	=> 'joryes1894@gmail.com',
            'password' 	=> bcrypt('123456789')
        ]);

        $user3 = User::create([
            'name'		=> 'Juan Perez Perez',
            'email'  	=> 'juanperez@gmail.com',
            'password' 	=> bcrypt('123456789')
        ]);

        factory(App\User::class, 10)->create();

        $user->roles()->sync(['1']);
        $user2->roles()->sync(['2']);
        $user3->roles()->sync(['3']);
    }
}
