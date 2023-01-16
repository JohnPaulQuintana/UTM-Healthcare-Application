<?php

namespace App\Http\Controllers;
use App\Events\UserNotification;
use Notification;
use App\Models\User;
use App\Models\Emergency;
use Illuminate\Http\Request;
use App\Http\Requests\EmergencyRequest;
use App\Http\Resources\EmergencyResource;
use App\Notifications\SendEmailNotification;
class EmergencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return EmergencyResource::collection(
            Emergency::where('status','pending')->get()
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmergencyRequest $request)
    {
        $request->validated($request->all());
        $emergencyNotif = Emergency::create([
            'emergency_description' => $request->emergency_description,
            'student_Id' => $request->student_Id,
            'student_Name' => $request->student_Name,
            'doctor_Id' => $request->doctor_Id,
            'doctor_Name' => $request->doctor_Name,
            'status' => $request->status,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        return new EmergencyResource($emergencyNotif);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Emergency  $emergency
     * @return \Illuminate\Http\Response
     */
    public function show(Emergency $emergency)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Emergency  $emergency
     * @return \Illuminate\Http\Response
     */
    public function edit(Emergency $emergency)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Emergency  $emergency
     * @return \Illuminate\Http\Response
     */
    public function update(EmergencyRequest $request)
    {
        $user = Emergency::where('student_Id',$request->id)->where('status','pending')->first();
        $user->doctor_Id = $request->doctor_Id;
        $user->doctor_Name = $request->doctor_Name;
        $user->status = $request->status;
        $user->save();

        // sending email notif
        $userEmail = User::where('id',$request->id)->first();
        $details = [
            'greeting'=>'Hello, from '.$request->doctor_Name,
            'body'=>'You dont need to worry about, ill sending you an ambulance as soon as posible. Just stay where you are ok.',
            'actiontext'=>'Ok',
            'actionurl'=>'http://127.0.0.1:8000/student',
            'lastline'=>'Thank you.'.$user->name,
            // 'useremail'=>
            // http://127.0.0.1:8000/student
        ];
        // event(new UserNotification($user));
        Notification::send($userEmail, new SendEmailNotification($details));
        return new EmergencyResource($user);
        // return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Emergency  $emergency
     * @return \Illuminate\Http\Response
     */
    public function destroy(Emergency $emergency)
    {
        //
    }
}
