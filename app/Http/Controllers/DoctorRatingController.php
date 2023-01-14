<?php

namespace App\Http\Controllers;

use App\Models\DoctorRating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\DoctorRatingRequest;
use App\Http\Resources\DoctorRatingResource;
use App\Models\BookSchedules;

class DoctorRatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DoctorRatingResource::collection(
            DoctorRating::get()//get all ratings
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
    public function store(DoctorRatingRequest $request)
    {
        $request->validated($request->all());
        $doctorRatings = DoctorRating::create([
            'student_id' => Auth::user()->id,
            'doctor_id' => $request->doctor_id,//later add id
            'feedback' => $request->feedback,
            'ratings' => $request->ratings
        ]);
        return new DoctorRatingResource($doctorRatings);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DoctorRating  $doctorRating
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $doctorRate = DoctorRatingResource::collection(
            DoctorRating::where('doctor_id',$id)->get()
        );
        // $doctorRate = DoctorRating::where('doctor_id',$id)->get();
        return $doctorRate;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DoctorRating  $doctorRating
     * @return \Illuminate\Http\Response
     */
    public function edit(DoctorRating $doctorRating)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DoctorRating  $doctorRating
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DoctorRating $doctorRating)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DoctorRating  $doctorRating
     * @return \Illuminate\Http\Response
     */
    public function destroy(DoctorRating $doctorRating,$id)
    {
        $user = BookSchedules::where('status','booked')->where('user_id',$id)->first();
        $user->delete();
        return $user;
    }
}
