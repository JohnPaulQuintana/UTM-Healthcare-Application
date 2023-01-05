<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmergencyResource extends JsonResource
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
            'emergency_description'=>$this->emergency_description,
            'student_Id'=>$this->student_Id,
            'student_Name'=>$this->student_Name,
            'doctor_Id'=>$this->doctor_Id,
            'doctor_Name'=>$this->doctor_Name,
            'status'=>$this->status,
            'latitude'=>$this->latitude,
            'longitude'=>$this->longitude,
        ];
    }
}
