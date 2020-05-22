<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->group(function () {

    // Roles
    Route::name('roles.')->group(function () {

        Route::post('roles/store', 'RoleController@store')->name('store')
            ->middleware('permission:roles.index');

        Route::get('roles', 'RoleController@index')->name('index')
            ->middleware('permission:roles.index');

        Route::get('roles/create', 'RoleController@create')->name('create')
            ->middleware('permission:roles.create');

        Route::put('roles/{role}', 'RoleController@update')->name('update')
            ->middleware('permission:roles.edit');

        Route::get('roles/{role}', 'RoleController@show')->name('show')
            ->middleware('permission:roles.show');

        Route::delete('roles/{role}', 'RoleController@destroy')->name('destroy')
            ->middleware('permission:roles.destroy');

        Route::get('roles/{role}/edit', 'RoleController@edit')->name('edit')
            ->middleware('permission:roles.edit');

    });

    // Cursos
    Route::name('courses.')->group(function () {

        Route::post('courses/store', 'CourseController@store')->name('store')
            ->middleware('permission:courses.index');

        Route::post('courses/update', 'CourseController@update')->name('update')
            ->middleware('permission:courses.edit');

        Route::get('courses', 'CourseController@index')->name('index')
            ->middleware('permission:courses.index');

        Route::get('courses/create', 'CourseController@create')->name('create')
            ->middleware('permission:courses.create');

        Route::get('courses/edit/{id}', 'CourseController@getCourse')
            ->middleware('permission:courses.edit');

        Route::get('courses/{course}', 'CourseController@show')->name('show')
            ->middleware('permission:courses.show');

        Route::delete('courses/{course}', 'CourseController@destroy')->name('destroy')
            ->middleware('permission:courses.destroy');

        Route::get('courses/{course}/edit', 'CourseController@edit')->name('edit')
            ->middleware('permission:courses.edit');

        Route::post('courses/assign', 'CourseController@assign')->name('assign')
            ->middleware('permission:courses.assign');

    });

    // Usuarios
    Route::name('users.')->group(function () {
        // TODO: Revisar estas rutas
        Route::get('users/create', 'UserController@create')->name('create')
            ->middleware('permission:users.create');

        Route::post('users/store', 'UserController@store')->name('store')
            ->middleware('permission:users.index');

        Route::get('users', 'UserController@index')->name('index')
            ->middleware('permission:users.index');

        Route::get('users/{user}/edit', 'UserController@edit')->name('edit')
            ->middleware('permission:users.edit');

        Route::put('users/{user}', 'UserController@update')->name('update')
            ->middleware('permission:users.edit');

        Route::get('users/{user}', 'UserController@show')->name('show')
            ->middleware('permission:users.show');

        Route::delete('users/{user}', 'UserController@destroy')->name('destroy')
            ->middleware('permission:users.destroy');

    });

    // Teachers
    Route::name('teachers.')->group(function () {

        Route::get('teachers', 'TeacherController@index')->name('index')
            ->middleware('permission:teachers.index');

        Route::post('teachers/store', 'TeacherController@store')->name('store')
            ->middleware('permission:teachers.index');

        Route::post('teachers/update', 'TeacherController@update')->name('update')
            ->middleware('permission:teachers.edit');

        Route::get('teachers/edit/{id}', 'TeacherController@getTeacher')
            ->middleware('permission:teachers.edit');

        Route::get('teachers/show/{id}', 'TeacherController@getTeacher')->name('show')
            ->middleware('permission:teachers.show');

        Route::delete('teachers/{teacher}', 'TeacherController@destroy')->name('destroy')
            ->middleware('permission:teachers.destroy');

        Route::get('teachers/{teacher}/edit', 'TeacherController@edit')->name('edit')
            ->middleware('permission:teachers.edit');


    });

    Route::get('teachers/getAll', 'TeacherController@getAll');

    Route::get('teachers/getTeachers/{idCourse}', 'TeacherController@getTeachers');


    // Cursos
    Route::name('permissions.')->group(function () {

        Route::post('permissions/store', 'PermissionController@store')->name('store')
            ->middleware('permission:permissions.index');

        Route::post('permissions/update', 'PermissionController@update')->name('update')
            ->middleware('permission:permissions.edit');

        Route::get('permissions', 'PermissionController@index')->name('index')
            ->middleware('permission:permissions.index');

        Route::get('permissions/create', 'PermissionController@create')->name('create')
            ->middleware('permission:permissions.create');

        Route::get('permissions/edit/{id}', 'PermissionController@getPermission')
            ->middleware('permission:permissions.edit');

        Route::get('permissions/{permission}', 'PermissionController@show')->name('show')
            ->middleware('permission:permissions.show');

        Route::delete('permissions/{permission}', 'PermissionController@destroy')->name('destroy')
            ->middleware('permission:permissions.destroy');

        Route::get('permissions/{permission}/edit', 'PermissionController@edit')->name('edit')
            ->middleware('permission:permissions.edit');

    });
});
