<?php

Route::group(['middleware' => 'web'], function(){

    Route::group(['middleware' => 'auth'], function(){

        Route::get('/', 'PagesController@home');

        Route::group(['middleware' => 'admin'], function(){

            Route::resource('teachers', 'TeacherController', ['except' => 'show']);
            Route::resource('students', 'StudentController', ['except' => 'show']);

            Route::group(['middleware' => 'teacher'], function(){

                Route::resource('courses', 'CourseController', ['except' => 'show']);
                Route::get('courses/{id}', 'CourseController@show');
                Route::resource('courseTimes', 'CourseTimeController', ['except' => 'show']);
                Route::resource('modules', 'ModuleController', ['except' => 'show']);
                Route::resource('exams', 'ExamController', ['except' => 'show']);

                Route::group(['prefix' => 'courses/{id}'], function(){

                    Route::get('linkStudents', 'CourseOthersController@students');

                });

            });

            Route::group(['middleware' => 'student'], function(){
                Route::resource('studentsCourses', 'StudentCourseController');
            });

        });

        Route::get('changePassword', 'ChangePasswordController@index');
        Route::post('changePassword/change', 'ChangePasswordController@change');

    });

    Route::auth();
});



