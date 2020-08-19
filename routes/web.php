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

//Auth::routes(['verify'=>true]);

//Route::get('/home', 'HomeController@index')->name('home');


//Route::get('/list',"UserController@show") ;
//Route::get('/edit/{id}',"UserController@edit") ;
//Route::get('/create',"UserController@create") ;
//Route::post('/store',"UserController@store") ;

//Route::resource('users', 'UserController', ['as' => 'admin']);
//Route::get('list', ['uses' => 'UserController@index', 'as' => 'web.user.tickets']);

//Route::prefix("/user/{user}")->group(function () {
//    Route::resource("courses", "UserCoursesController", ['as' => "user"])
//        ->parameter('courses', 'userCourse');
//});

Route::resource('users',"UserController");
Route::resource('courses',"CourseController");
Route::resource('users.courses',"UserCoursesController");
Route::get('users/{user}/courses/{course}/check',"UserCoursesController@checkUserCourseRelation")->name('users.courses.check');
Route::resource('courses.users',"CourseUsersController");
Route::resource('contact','ContactController');

