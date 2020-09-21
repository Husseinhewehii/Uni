<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



//Route::get('send-notification',function(){
////    $user = auth()->user();
////    $user->notify(new Benachrichtigung($user));
////    event(new BenachrichtigungEvent($user));
//    return redirect()->back();
//})->name('send_notification');


//Route::resource('users.courses',"API\UserCoursesController")->except(['show']);
//Route::DELETE('users/{user}/courses/{course}/delete-student',"API\UserCoursesController@destroyStudent")->name('users.courses.destroy.student');
//Route::get('users/{user}/courses/index-student',"API\UserCoursesController@indexStudent")->name('users.courses.index.student');

Route::prefix('/')->attribute('namespace', 'Api')->group(function () {
    Route::resource('users',"UserController");
    Route::post('/register', ['uses' => 'AuthController@register', 'as' => 'api.auth.register']);
    Route::resource('courses',"CourseController");
    Route::post('/login',"AuthController@login");
    Route::post('/users/password-reset',"UserController@sendPasswordResetLink");

    Route::get('/users/{user}/notifications','UserController@getNotifications');
    Route::get('send-notification/{user}','UserController@postNotification');


});
Route::prefix('/')->attribute('namespace', 'Api')->middleware('auth:api')->group(function () {
    Route::resource('users',"UserController");
    //Route::get('/user-update',"UserController@update")->name('api.user.update');
    Route::get('/student-courses',"UserController@studentCourses")->name('api.student.courses');

});

//Route::post('login-custom','LoginController@login')->name('login.custom');
