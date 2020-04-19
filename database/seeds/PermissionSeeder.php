<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Users
        Permission::create([
            'name'          => 'Navegar usuarios',
            'slug'          => 'users.index',
            'description'   => 'Lista y navega todos los usuarios del sistema',
        ]);

        Permission::create([
            'name'          => 'Ver detalle de usuario',
            'slug'          => 'users.show',
            'description'   => 'Ve en detalle cada usuario del sistema',
        ]);

        Permission::create([
            'name'          => 'Edición de usuarios',
            'slug'          => 'users.edit',
            'description'   => 'Podría editar cualquier dato de un usuario del sistema',
        ]);

        Permission::create([
            'name'          => 'Eliminar usuario',
            'slug'          => 'users.destroy',
            'description'   => 'Podría eliminar cualquier usuario del sistema',
        ]);

        //Roles
        Permission::create([
            'name'          => 'Navegar roles',
            'slug'          => 'roles.index',
            'description'   => 'Lista y navega todos los roles del sistema',
        ]);

        Permission::create([
            'name'          => 'Ver detalle de un rol',
            'slug'          => 'roles.show',
            'description'   => 'Ve en detalle cada rol del sistema',
        ]);

        Permission::create([
            'name'          => 'Creación de roles',
            'slug'          => 'roles.create',
            'description'   => 'Podría crear nuevos roles en el sistema',
        ]);

        Permission::create([
            'name'          => 'Edición de roles',
            'slug'          => 'roles.edit',
            'description'   => 'Podría editar cualquier dato de un rol del sistema',
        ]);

        Permission::create([
            'name'          => 'Eliminar roles',
            'slug'          => 'roles.destroy',
            'description'   => 'Podría eliminar cualquier rol del sistema',
        ]);

        //Cursos
        Permission::create([
            'name'          => 'Navegar cursos',
            'slug'          => 'courses.index',
            'description'   => 'Lista y navega todos los cursos del sistema',
        ]);

        Permission::create([
            'name'          => 'Ver detalle de un curso',
            'slug'          => 'courses.show',
            'description'   => 'Ve en detalle cada curso del sistema',
        ]);

        Permission::create([
            'name'          => 'Creación de cursos',
            'slug'          => 'courses.create',
            'description'   => 'Podría crear nuevos cursos en el sistema',
        ]);

        Permission::create([
            'name'          => 'Edición de cursos',
            'slug'          => 'courses.edit',
            'description'   => 'Podría editar cualquier dato de un curso del sistema',
        ]);

        Permission::create([
            'name'          => 'Eliminar cursos',
            'slug'          => 'courses.destroy',
            'description'   => 'Podría eliminar cualquier curso del sistema',
        ]);
    }
}
