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
            // 'students' =>  UserResource::collection($this->students),
            'status' => $this->status,
            'active' => $this->active
        ];
    }

}
