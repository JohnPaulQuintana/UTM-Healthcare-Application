<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
// use Carbon\Carbon;
class SchedulesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // Starting Time
        // $str_Time = Carbon::create($this->starting_time);
        // $starting_Time = $str_Time->format('g:i A');
        // End TIme
        // $en_Time = Carbon::create($this->end_time);
        // $end_Time = $en_Time->format('g:i A');
        // week

        // $date = Carbon::createFromDate($this->day)->format('l jS \of F Y');
        
        // if($this->user_id === $this->doctor_id ){
        //     $ratingTotals = $this->ratings->sum();
        // }

        return [
            'id' => (string)$this->id,
            'attributes' => [
                'doctor_id' => $this->user_id,
                'starting_time' => $this->starting_time,
                // 'end_time' => $end_Time,
                'day' => $this->day,
                'created_at' => date('d-m-Y', strtotime($this->created_at)),
                'updated_at' => $this->updated_at
            ],
            'relationships' => [
                'id' => (string)$this->user->id,
                'username' => $this->user->name,
                'useremail' => $this->user->email,
                'userspeciality' => $this->user->speciality,
                'userdetails' => $this->user->about
            ],
            "ratings" => [
                'id' => $this->id,
                'rating' => $this->ratings,
                'feedback' => $this->feedback
            ]
            
        ];
    }
}
