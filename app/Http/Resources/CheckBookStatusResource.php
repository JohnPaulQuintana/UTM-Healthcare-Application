<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CheckBookStatusResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
         /*
            0: 
            created_at: "2023-01-03T13:23:11.000000Z"
            date:"Jan, 2023, 4, We"
            details:"optional"
            id:7
            schedule_id:2
            status:"pending"
            time:"02:53 AM"
            updated_at: "2023-01-03T13:23:11.000000Z"
            user_id:1
        */
        return [
            'id' => (string)$this->id,
            'status' => $this->status,
            'schedule_id' => (string)$this->schedule_id,
            'user_id' => $this->user_id,
            'time' => $this->time,
            'date' => $this->date,
            'details' => $this->details

        ];
    }
}
