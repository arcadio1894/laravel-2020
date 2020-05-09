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
        factory(App\User::class, 10)->create();

        // TODO: Rol por defecto
        Role::create([
            'name'		=> 'Admin',
            'slug'  	=> 'admin',
            'special' 	=> 'all-access'
        ]);

        $user = User::create([
            'name'		=> 'Administrador',
            'email'  	=> 'admin@example.com',
            'password' 	=> bcrypt('123456789')
        ]);

        $user->roles()->sync(['1']);
    }
}
