<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmergencyRequest;
use App\Models\Schedule;
use App\Models\DoctorRating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ScheduleRequest;
use App\Http\Resources\SchedulesResource;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SchedulesResource::collection(
            Schedule::where('user_id',  Auth::user()->id)->get()//get all where login user = user_id
            // Schedule::all()
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
    public function store(ScheduleRequest $request)
    {
     
        // dd($id);
        $request->validated($request->all());
        $sched = Schedule::create([
            'user_id' => Auth::user()->id,
            'starting_time' => $request->starting_time,
            // 'end_time' => $request->end_time,
            'day' => $request->day,
            'status' => 'active',
        ]);

        // store default ratings
        DoctorRating::create([
            'student_id' => Auth::user()->id,
            'doctor_id' => Auth::user()->id,//later add id
            'feedback' => 'There is no ratings available' ,
            'ratings' => 0
        ]);

        return new SchedulesResource($sched);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show(Schedule $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit(Schedule $schedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $updateSched = Schedule::where('user_id',$request->schedule_id)->where('status','active')->get();
        // $date = "2020-02-22";
        // $newDate = \Carbon\Carbon::createFromFormat('Y-m-d', $date)->format('d M Y');
        $data = [];
        for ($i=0; $i < count($updateSched); $i++) { 
            $data[$i] = $updateSched[$i];

            $week = \Carbon\Carbon::createFromFormat('Y-m-d', $data[$i]->day)->format('l');
            $mon = \Carbon\Carbon::createFromFormat('Y-m-d', $data[$i]->day)->format('M');
            $day = \Carbon\Carbon::createFromFormat('Y-m-d', $data[$i]->day)->format('d');
            $year = \Carbon\Carbon::createFromFormat('Y-m-d', $data[$i]->day)->format('Y');

            $newDate = $mon.', '.$year.', '.$day.', '.$week[0].$week[1]; 
            if($newDate == $request->date){
                        // break;
                        $tama = 'tama : index '.$i;
                        $data = $data[$i];
                        $updateSched[$i]->status = 'booked';
                        $updateSched[$i]->starting_time = $request->time;
                        $updateSched[$i]->day = $request->date;
                        $updateSched[$i]->save();
                        
                        return $tama;
                    }else{
        
                    }
        }
        // return $data;

        // foreach($updateSched as $key => $val){
            
        //     $data = $updateSched->push((object)['keys' => $key]);
        // //    $date = $val->day;
        //     // $newDate = \Carbon\Carbon::createFromFormat('Y-m-d', $date)->format(' l d M Y');
        //     // $week = \Carbon\Carbon::createFromFormat('Y-m-d', $date)->format('l');
        //     // $mon = \Carbon\Carbon::createFromFormat('Y-m-d', $date)->format('M');
        //     // $day = \Carbon\Carbon::createFromFormat('Y-m-d', $date)->format('d');
        //     // $year = \Carbon\Carbon::createFromFormat('Y-m-d', $date)->format('Y');
            

           
        //     //     $newDate = $mon.', '.$year.', '.$day.', '.$week[0].$week[1]; 
        //         // $data = $updateSched->push((object)['data' => $newDate]);
        //     // if($newDate == $request->date){
        //     //     // break;
        //     //     // $data = "tama : ";
        //     //     // $updateSched[$key]->status = 'booked';
        //     //     // $updateSched[$key]->starting_time = 'booked';
        //     //     // $updateSched[$key]->day = '2021-1-23';
        //     //     // $updateSched->save();
                
        //         // return $data;
        //     // }else{

        //     // }
        //     return $data;
        // }
        
        
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        //
    }
}
