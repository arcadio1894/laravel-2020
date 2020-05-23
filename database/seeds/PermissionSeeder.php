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

        // Student
        Permission::create([
            'name'          => 'Ver sus cursos',
            'slug'          => 'student.showcourse',
            'description'   => 'Puede visualizar sus cursos inscritos',
        ]);
        Permission::create([
            'name'          => 'Ver temas de sus cursos',
            'slug'          => 'student.showtasks',
            'description'   => 'Puede visualizar los temas sus cursos inscritos',
        ]);
        Permission::create([
            'name'          => 'Descargar contenido',
            'slug'          => 'student.download',
            'description'   => 'Puede descargar contenido',
        ]);
        Permission::create([
            'name'          => 'Visualizar su perfil',
            'slug'          => 'student.perfilshow',
            'description'   => 'Puede visualizar su perfil',
        ]);
        Permission::create([
            'name'          => 'Editar su perfil',
            'slug'          => 'student.perfiledit',
            'description'   => 'Puede editar su perfil',
        ]);
        Permission::create([
            'name'          => 'Ver profesor del curso',
            'slug'          => 'student.teacher',
            'description'   => 'Puede visualizar los datos del profesor',
        ]);
        Permission::create([
            'name'          => 'Ver estudiantes',
            'slug'          => 'student.showothers',
            'description'   => 'Puede visualizar los nombres de los estudiantes',
        ]);
        Permission::create([
            'name'          => 'Subir archivos',
            'slug'          => 'student.upload',
            'description'   => 'Puede subir archivos al tema',
        ]);
        Permission::create([
            'name'          => 'Hacer comentarios',
            'slug'          => 'student.comment',
            'description'   => 'Puede hacer comentarios',
        ]);
        Permission::create([
            'name'          => 'Cancelar suscripcion',
            'slug'          => 'student.cancel',
            'description'   => 'Puede cancelar la suscripcion a un curso',
        ]);

        // teacher
        Permission::create([
            'name'          => 'Ver sus cursos',
            'slug'          => 'teacher.showcourse',
            'description'   => 'Puede visualizar sus cursos programados',
        ]);
        Permission::create([
            'name'          => 'Ver temas de sus cursos',
            'slug'          => 'teacher.showtasks',
            'description'   => 'Puede visualizar los temas sus cursos programados',
        ]);
        Permission::create([
            'name'          => 'Editar temas de sus cursos',
            'slug'          => 'teacher.edittasks',
            'description'   => 'Puede visualizar los temas sus cursos programados',
        ]);
        Permission::create([
            'name'          => 'Eliminar temas de sus cursos',
            'slug'          => 'teacher.deletetasks',
            'description'   => 'Puede visualizar los temas sus cursos programados',
        ]);
        Permission::create([
            'name'          => 'Ver contenido de sus temas',
            'slug'          => 'teacher.showcontent',
            'description'   => 'Puede visualizar los temas sus cursos programados',
        ]);
        Permission::create([
            'name'          => 'Editar contenido de sus temas',
            'slug'          => 'teacher.editcontent',
            'description'   => 'Puede visualizar los temas sus cursos programados',
        ]);
        Permission::create([
            'name'          => 'Eliminar contenido de sus temas',
            'slug'          => 'teacher.deletecontent',
            'description'   => 'Puede visualizar los temas sus cursos programados',
        ]);
        Permission::create([
            'name'          => 'Descargar contenido',
            'slug'          => 'teacher.download',
            'description'   => 'Puede descargar contenido',
        ]);
        Permission::create([
            'name'          => 'Visualizar su perfil',
            'slug'          => 'teacher.perfilshow',
            'description'   => 'Puede visualizar su perfil',
        ]);
        Permission::create([
            'name'          => 'Editar su perfil',
            'slug'          => 'teacher.perfiledit',
            'description'   => 'Puede editar su perfil',
        ]);
        Permission::create([
            'name'          => 'Ver estudiantes',
            'slug'          => 'teacher.showstudents',
            'description'   => 'Puede visualizar los nombres de los estudiantes',
        ]);
        Permission::create([
            'name'          => 'Asignar calificativo estudiantes',
            'slug'          => 'teacher.calificar',
            'description'   => 'Puede calificar a los estudiantes',
        ]);
        Permission::create([
            'name'          => 'Subir archivos',
            'slug'          => 'teacher.upload',
            'description'   => 'Puede subir archivos al tema',
        ]);
        Permission::create([
            'name'          => 'Hacer comentarios',
            'slug'          => 'teacher.comment',
            'description'   => 'Puede hacer comentarios',
        ]);
        Permission::create([
            'name'          => 'Enviar correo',
            'slug'          => 'teacher.send',
            'description'   => 'Puede enviar correos a los estudiantes',
        ]);
    }
}
