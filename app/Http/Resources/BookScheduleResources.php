<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookScheduleResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => (string)$this->id,
            'status' => $this->status,
            'attributes' => [
                'student_id' =>$this->user_id,
                'student_name' => $this->name,
                'student_email' => $this->email,
                'details' => $this->details,
                
            ],
            'relationships' => [
                'doctor_id' => (string)$this->schedule_id,
                // 'username' => $this->user->name,
                // 'useremail' => $this->user->email,
                // 'userspeciality' => $this->user->speciality,
            ],
        ];
    }
}
