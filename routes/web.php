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



    });

    Route::get('teachers/getAll', 'TeacherController@getAll');

    Route::get('teachers/getTeachers/{idCourse}', 'TeacherController@getTeachers');


    // Permission
    Route::name('permission.')->group(function () {

        Route::get('permission', 'PermissionController@index')->name('index')
            ->middleware('permission:permission.index');

        Route::post('permission/update', 'PermissionController@update')->name('update')
            ->middleware('permission:permission.edit');
        
        Route::get('permission/edit/{id}', 'PermissionController@edit')
            ->middleware('permission:permission.edit');

        Route::post('permission/store','PermissionController@store')->name('store')
            ->middleware('permission:courses.index');

        Route::delete('permission/{permission}', 'PermissionController@destroy')->name('destroy')
            ->middleware('permission:permission.destroy');

    });


});

