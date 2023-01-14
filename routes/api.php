<?php

use App\Events\UserNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
// use App\Http\Controllers\TasksController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\BookSchedulesController;
use App\Http\Controllers\DoctorRatingController;
use App\Http\Controllers\EmergencyController;
use App\Models\BookSchedules;
use App\Models\Schedule;

// use App\Models\DoctorRating;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// // public routes
Route::post('/login',[AuthController::class, 'login']);
Route::post('/register',[AuthController::class, 'register']);
Route::post('/forgot-password',[AuthController::class, 'forgotPassword']);
Route::post('/update/{id}',[AuthController::class, 'update']);

// // protected routes 
Route::group(['middleware' => ['auth:sanctum']], function(){
    // Route::resource('/schedule',DoctorScheduleController::class); //pending for now 
    // Route::get('/sched',[ScheduleController::class, 'index']);
    Route::resource('/bookschedule', BookSchedulesController::class);
    Route::get('/checkStatus/{id}', [BookSchedulesController::class, 'checkStatus']);
    Route::get('/checkStatusPending/{id}', [BookSchedulesController::class, 'checkStatusPending']);
    Route::get('/checkStatusRejected/{id}', [BookSchedulesController::class, 'checkStatusRejected']);
    Route::resource('/sched', ScheduleController::class);
    Route::resource('/student', StudentController::class);
    Route::get('/StatusDone', [StudentController::class, 'StatusDone']);
    Route::post('/update/{id}',[AuthController::class, 'updateProfile']);
    Route::delete('/delete/{id}',[AuthController::class, 'destroy']);
    Route::post('/logout',[AuthController::class, 'logout']);

    Route::resource('/ratings', DoctorRatingController::class);
    Route::resource('/emergency',EmergencyController::class);

    Route::get('send/{id}',[BookSchedulesController::class, 'sendnotification']);
    Route::get('sendToStudent/{id}',[BookSchedulesController::class, 'sendnotificationStudent']);
    Route::get('sendToAll/{id}',[BookSchedulesController::class, 'sendnotificationAll']);
    Route::post('fireevent/{id}',[BookSchedulesController::class, 'pusherNotify']);
    
   
});
// Route::post('fireevent',[BookSchedulesController::class, 'pusherNotify']);
 // notify
//  Route::post('/fireevent',function(){
//     $name = request()->name;
//     event(new UserNotification($name));
//  });
//  Route::post('/fireevent',[BookSchedulesController::class, 'pusherNotify']);
 

 
// schedule
// Route::get('/sched',[ScheduleController::class, 'index']);

// for debug
// Route::get('/student', [StudentController::class, 'index']);
// Route::post('/sched/{id}', [ScheduleController::class, 'store']);
// Route::resource('/sched', ScheduleController::class);