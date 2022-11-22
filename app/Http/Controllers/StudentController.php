<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Http\Resources\SchedulesResource;
use App\Models\DoctorRating;
use League\CommonMark\Extension\Attributes\Node\Attributes;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // ->join('Users','Users.id', '=', 'book_schedules.user_id')
        // ->where('status', 'pending')
        // ->get());//get all where login user = user_id
        // original
        // return SchedulesResource::collection(
        //     Schedule::where('status',  'active')->get()//get all
        // );

        $doctor = Schedule::where('status','active')->get();
        // $ratings = DoctorRating::where()->get();
        // dd($ratings->all());
        // dd($doctor->starting_time);
        // $ratings->mapWithKeys(function($item, $key){
        //     return [$item['doctor_id'] => $item['doctor_id']];
        // });
       
        // dd($doctor[0]);
        $ratingsCollection = SchedulesResource::collection(
            Schedule::where('status','active')
            // ->join('doctor_ratings', 'doctor_id', '=', 'schedules.user_id')
            ->join('doctor_ratings', 'doctor_id', '=', 'schedules.user_id')
            // ->where('doctor_id','schedules.user_id')->sum('ratings')
            // ->where(function($query){
            //     $query->where('doctor_id','=','schedules.user_id')->groupBy('doctor_id')->sum('ratings');
            // })
            ->get()
        
        );

        return $ratingsCollection;

        // dd($ratingsCollection->duplicates(attributes->doctor_id));
        // $rating_sum = DoctorRating::where('doc')
        // dd($ratingsCollection);
        // return $ratingsCollection;

        // return SchedulesResource::collection(
        //     DoctorRating::where('ratings', '!=', 0)
        //         ->join('schedules', 'user_id', '=', 'doctor_ratings.doctor_id')
        //         ->where(function($query){
        //             $query->where('doctor_id','=','schedules.user_id')->sum('ratings');
        //         })
        //         ->get()
        // );
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return SchedulesResource::collection(
            Schedule::where('user_id',  $id)->get()//get all
            
            
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
