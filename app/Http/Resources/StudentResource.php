<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return[
            'id' => (string)$this->id,
            'attributes' => [
                'starting_time' => $this->starting_time,
                'end_time' => $this->end_time,
                'day' => $this->day,
                'created_at' => date('d-m-Y', strtotime($this->created_at)),
                'updated_at' => $this->updated_at
            ],
            'relationships' => [
                'id' => (string)$this->user->id,
                'username' => $this->user->name,
                'useremail' => $this->user->email
            ]
        ];
    }
}
