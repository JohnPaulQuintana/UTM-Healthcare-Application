<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConsultationRequest;

use Illuminate\Http\Request;
use App\Models\BookSchedules;

use Illuminate\Support\Facades\Auth;
use App\Http\Resources\BookScheduleResources;
use App\Http\Resources\CheckBookStatusResource;
use Brick\Math\BigInteger;

class BookSchedulesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return BookScheduleResources::collection(  
            BookSchedules::where('schedule_id', Auth::user()->id)
            ->join('Users','Users.id', '=', 'book_schedules.user_id')
            ->where('status', 'pending')
            ->get());//get all where login user = user_id
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
    public function store(ConsultationRequest $request)
    {
        $request->validated($request->all());
        $bookSchedules = BookSchedules::create([
            'user_id' => Auth::user()->id,
            'schedule_id' => $request->schedule_id,
            'details' => $request->details,
            'status' => $request->status,
            'date' => $request->date,
            'time' => $request->time,

        ]);

        return new BookScheduleResources($bookSchedules);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BookSchedules  $bookSchedules
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        return CheckBookStatusResource::collection(
            BookSchedules::where('user_id', $id)->get()
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BookSchedules  $bookSchedules
     * @return \Illuminate\Http\Response
     */
    public function edit(BookSchedules $bookSchedules)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BookSchedules  $bookSchedules
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BookSchedules $bookSchedules)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BookSchedules  $bookSchedules
     * @return \Illuminate\Http\Response
     */
    public function destroy(BookSchedules $bookSchedules)
    {
        //
    }
}
