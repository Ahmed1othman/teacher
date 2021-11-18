<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'time' => $this->time,
            'type' => $this->type,
            'teacher' => new UserResource($this->teacher()->first()),
            'category' => new CategoryResource($this->category()->first()),
            'students' =>  $this->studentes,
            'active' => $this->active
        ];
    }

}
