<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
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
            'appointment' => new AppointmentResource($this->appointment()->first()),
            'student' => new UserResource($this->student()->first()),
            'active' => $this->active
        ];
    }

}
