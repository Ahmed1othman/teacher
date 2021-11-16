<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LectureResource extends JsonResource
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
            'name' => $this->name,
            'time' => $this->time,
            'photo' => $this->image,
            'type' => $this->type,
            'category' => new CategoryResource($this->category()->first()),
            'user' => new UserResource($this->user()->first()),
            'month' => $this->month,
            'active' => $this->active
        ];
    }

}
