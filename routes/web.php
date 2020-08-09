<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $courses = \App\Course::all();
    return view('welcome', compact('courses'));

})->name('/');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/contact', 'EmailController@getcontact')->name('get_contact');
Route::post('/contact', 'EmailController@sendcontact')->name('send_contact');

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

        Route::get('courses/subjects/{id}', 'CourseController@subjects')->name('subjects')
            ->middleware('permission:teacher.showtasks');

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

        Route::get('teachers/showCourse', 'TeacherController@showCourse')->name('showCourse')
            ->middleware('permission:teacher.showCourse');

        Route::post('teachers/sendEmail', 'EmailController@sendEmailTeacher')->name('email')
            ->middleware('permission:teacher.destroy');

    });

    Route::name('exports.')->group(function () {

        Route::get('exports/courses/pdf', 'ExportController@exportCoursesPDF')->name('coursesPDF')
            ->middleware('permission:courses.create');

        Route::get('exports/course/pdf/{id}', 'ExportController@exportCoursePDF')->name('coursePDF')
            ->middleware('permission:courses.create');

        Route::get('exports/courses/excel', 'ExportController@exportCoursesEXCEL')->name('coursesEXCEL')
            ->middleware('permission:courses.create');

        Route::get('exports/course/excel/{id}', 'ExportController@exportCourseEXCEL')->name('courseEXCEL')
            ->middleware('permission:courses.create');

        Route::get('exports/teachers/excel', 'ExportController@exportTeachersEXCEL')->name('teachersEXCEL')
            ->middleware('permission:courses.create');
    });

    Route::name('subjects.')->group(function () {

        Route::post('subjects/store', 'SubjectController@store')->name('store')
            ->middleware('permission:courses.create');

        Route::post('subjects/delete/{id}', 'SubjectController@destroy')->name('delete')
            ->middleware('permission:courses.create');
    });

    Route::get('teachers/getAll', 'TeacherController@getAll');

    Route::get('teachers/getTeachers/{idCourse}', 'TeacherController@getTeachers');

    Route::get('carbon', 'TeacherController@carbon');

    // TODO: Rutas de las paginas de errores

    Route::get('404', 'ErrorController@error404')->name('404');
    Route::get('405', 'ErrorController@error405')->name('405');

    Route::get('send/courseEnrolled/{course_id}', 'EmailController@sendCourseEnrolled')->name('send.course.enrolled');
    Route::get('listen/courseEnrolled', 'EmailController@listenCourseEnrolled')->name('listen.course.enrolled');

    // TODO: Rutas de vue
    Route::get('/comments/{course_id}', 'CommentController@index');
    Route::post('/comments', 'CommentController@store');
    Route::put('/comment/{comment_id}', 'CommentController@update');
    Route::delete('/comment/{comment_id}', 'CommentController@destroy');
});

Route::name('landing.')->group(function () {

    Route::get('course/details/{id}', 'CourseController@courseDetails')->name('course');
    Route::get('course/all/', 'CourseController@courseAll')->name('courses');
    Route::get('admissions', 'CourseController@admissions')->name('admissions');
    Route::get('about', 'CourseController@about')->name('about');
    Route::get('teacher/all', 'TeacherController@teachers')->name('teachers');
});

// TODO: Lazy loading and Eager Loading
Route::get('lazy/loading', 'ErrorController@lazy');
Route::get('eager/loading', 'ErrorController@eager');

