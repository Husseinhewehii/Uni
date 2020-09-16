<?php

use App\Jobs\SendEmailJob;
use App\Jobs\PrinterJob;

use Carbon\Carbon;
use App\Notifications\Benachrichtigung;
use App\Models\User;
use App\Events\BenachrichtigungEvent;

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



Route::get('', function () {
    return view('welcome');
})->name('home');

Auth::routes(['verify'=>true]);

Route::get('/logged-in', 'HomeController@index')->name('logged_in');




Route::get('users/index-student',"UserController@indexStudents")->name('users.index.students');
Route::get('users/index-professor',"UserController@indexProfessors")->name('users.index.professors');
Route::get('users/index-admin',"UserController@indexAdmins")->name('users.index.admins');
Route::get('users/login',"UserController@goLogin")->name('users.go.login');
Route::get('users/password-forgot','UserController@forgotPassword')->name('users.password.forgot');
Route::post('users/password-reset','UserController@sendPasswordResetLink')->name('users.password.reset.link');
Route::get('/password/go-reset','UserController@goReset')->name('password.reset');
Route::post('/password/reset','UserController@resetPassword')->name('users.password.reset');
Route::get('/password/go-change/{user}','UserController@goChangePassword')->name('users.password.go.change');
Route::post('/password/change/{user}','UserController@updatePassword')->name('users.password.change');
Route::resource('users',"UserController");


Route::get('export', 'MyController@export')->name('export');
Route::get('importExportView', 'MyController@importExportView')->name('users.go.import');
Route::post('import', 'MyController@import')->name('import');


Route::resource('courses',"CourseController");
Route::get('course-export-pdf/{course}/{form}',"CourseController@exportPDF")->name('course.export.pdf');

Route::get('courses-export-excel', 'CourseController@exportExcel')->name('courses.export.excel');
//Route::get('importExportView', 'CourseController@importExportView');
//Route::post('course-import-excel', 'CourseController@importExcel')->name('course.import.excel');
Route::get('courses-insert-twenties', 'CourseController@courseInsert')->name('courses.insert.twenties');


Route::DELETE('users/{user}/courses/{course}/delete-student',"UserCoursesController@destroyStudent")->name('users.courses.destroy.student');
Route::delete('users/{user}/courses/{course}/delete-professor',"UserCoursesController@destroyProfessor")->name('users.courses.destroy.professor');
Route::get('users/{user}/courses/index-student',"UserCoursesController@indexStudent")->name('users.courses.index.student');
Route::get('users/{user}/courses/index-professor',"UserCoursesController@indexProfessor")->name('users.courses.index.professor');
Route::resource('users.courses',"UserCoursesController")->except(['show']);




Route::resource('courses.users',"CourseUsersController");
Route::get('course-users-export-excel/{course}','CourseUsersController@exportExcel')->name('course.users.export.excel');

Route::resource('course.reviews',"CourseReviewController");


Route::resource('user.gallery','UserGalleryController');


Route::resource('permissions','PermissionController');
Route::resource('groups','GroupController');
Route::resource('group.users','GroupUsersController');
Route::resource('group.permissions','GroupPermissionsController');



Route::post('login/custom','LoginController@login')->name('login.custom');

Route::get('logs','LogsController@index')->name('logs.index');





//----------------------------------------------------------------------------------------------------------





//Route::get('insert_many_courses',function(){
//
//    $job = (new InsertCourses);
//    dispatch($job);
//    return redirect()->back();
//})->name('insert_many_courses');











//Route::get('/ajax-form', 'ajaxcontroller@ajax_form');
//Route::post('/ajax', 'ajaxcontroller@ajax');

//Route::get('send-email',function(){
//
//    $job = (new SendEmailJob())->delay(Carbon::now()->addSeconds(15));
//    dispatch($job);
//    return 'email has just been sent';
//});

//Route::get('print-something',function(){
//
//    $job = (new PrinterJob);
//    dispatch($job);
//    return '100000 users added';
//});


Route::get('send-notification',function(){
    $user = auth()->user();
    $user->notify(new Benachrichtigung($user));
    event(new BenachrichtigungEvent($user));
    return redirect()->back();
})->name('send_notification');

Route::get('mark-as-read',function (){
    $user = auth()->user();
    $user->unreadNotifications->markAsRead();
    return redirect()->back();
})->name('mark_read');
//

//
//Route::group(['prefix' => '{language}'],function(){
//
//    Route::get('home', function () {
//        return view('welcome');
//    })->name('welcome');
//
//    Route::get('translate',function (){
////        App::setlocale('de');
////    echo App::getLocale();die;
//
//
//
////        if (App::isLocale('en')){
////            App::setlocale('de');
////
////
////        }elseif(App::isLocale('de')){
////            App::setlocale('en');
////
////        }
////
////        return redirect()->back();
//    })->name('translate');
//
//});
