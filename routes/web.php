<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify'=>true]);

Route::get('/home', 'HomeController@index')->name('home');




Route::get('users/index-student',"UserController@indexStudents")->name('users.index.students');
Route::get('users/index-professor',"UserController@indexProfessors")->name('users.index.professors');
Route::get('users/index-admin',"UserController@indexAdmins")->name('users.index.admins');
Route::get('users/login',"UserController@goLogin")->name('users.go.login');
Route::resource('users',"UserController");


Route::resource('courses',"CourseController");


Route::DELETE('users/{user}/courses/{course}/delete-student',"UserCoursesController@destroyStudent")->name('users.courses.destroy.student');
Route::delete('users/{user}/courses/{course}/delete-professor',"UserCoursesController@destroyProfessor")->name('users.courses.destroy.professor');
Route::get('users/{user}/courses/index-student',"UserCoursesController@indexStudent")->name('users.courses.index.student');
Route::get('users/{user}/courses/index-professor',"UserCoursesController@indexProfessor")->name('users.courses.index.professor');
Route::resource('users.courses',"UserCoursesController")->except(['show']);



Route::resource('courses.users',"CourseUsersController");


Route::resource('permissions','PermissionController');
Route::resource('groups','GroupController');
Route::resource('group.users','GroupUsersController');
Route::resource('group.permissions','GroupPermissionsController');



Route::get('/ajax-form', 'ajaxcontroller@ajax_form');
Route::post('/ajax', 'ajaxcontroller@ajax');


Route::post('login/custom','LoginController@login')->name('login.custom');

//Route::group(['middleware'=>'auth'],function (){
//
//});
