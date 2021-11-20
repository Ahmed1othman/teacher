<?php

namespace App\Http\Resources;
use App\Http\Resources\CountryResource;
use App\Http\Resources\CityResource;
use App\Http\Resources\PackageResource;
use App\Models\Appointment;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed id
 * @property mixed name
 * @property mixed email
 * @property mixed phone
 * @property mixed avatar
 * @property mixed type
 * @property mixed position
 * @property mixed active
 * @property mixed roles
 */
class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        $appointments =Appointment::where('user_id',$this->id)->get();
        $student_number=0;
        
        foreach($appointments as $appointment){
            $student_number+=Book::where('appointment_id',$appointment->id)->count();
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'rate' => $this->rate,
            'type' => $this->type,
            'image' => $this->photo,
            'price' => $this->price,
            'bio' => $this->bio,
            'student_number' => $student_number,
            'categories' => $this->categories,
            'active' => $this->active,
            'create_dates' => [
                'created_at_human' => $this->created_at->diffForHumans(),
                'created_at' => $this->created_at
            ],
            'update_dates' => [
                'updated_at_human' => $this->updated_at->diffForHumans(),
                'updated_at' => $this->updated_at
            ],

        ];
    }
}
