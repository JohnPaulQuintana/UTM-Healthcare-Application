<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Schedule;
use App\Models\DoctorRating;
use Illuminate\Http\Request;
use App\Models\BookSchedules;
use App\Http\Resources\SchedulesResource;
use League\CommonMark\Extension\Attributes\Node\Attributes;

class StudentController extends Controller
{
    // /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function doctor()
    // {

    // }
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $doctor = Schedule::where('status','active')->get();
        
        $ratingsCollection = SchedulesResource::collection(
            Schedule::where('status','active')
    
            ->join('doctor_ratings', 'doctor_id', '=', 'schedules.user_id')
           
            ->get()
        
        );

        return $ratingsCollection;
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
            Schedule::where('user_id',  $id)->where('status','active')->get()//get all
            
            
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function StatusDone()
    {
        $weekStr = ['Mo', 'Tu', 'We','Th','Fr','Sa','Su'];
        $monStr = ['Jan', 'Feb', 'Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
        $date = Carbon::now();
        $date->toArray();
        $day = $date->day;
        $weekName = $weekStr[$date->dayOfWeek-1];
        $month = $monStr[$date->month-1];
        $year = $date->year;

        $matchedDate = $month.', '.$year.', '.$day.', '.$weekName;
        $appointmentDone = BookSchedules::where('status','booked')
        ->where('date',$matchedDate)
        ->get();

        
       
        return $appointmentDone;
    }

    
}
