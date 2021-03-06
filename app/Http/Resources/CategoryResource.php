<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'single_price' => $this->single_price,
            'group_price' => $this->group_price,
            'photo' => $this->image,
            'teachers_number' => count($this->teachers),
            'teachers' =>  UserResource::collection($this->teachers),
        ];
    }
}
