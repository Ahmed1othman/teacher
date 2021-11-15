<?php

namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }


    public function rules()
    {


        switch ($this->method()) {
            case 'GET':
            case 'DELETE':
            {
                return [];
            }
            case 'POST':
            {
                return [
                    'name' => 'required|string|min:2|unique:categories,name,NULL,id,deleted_at,NULL',
                    'photo'=>'required|image|mimes:jpeg,bmp,png|max:4096'
                ];
            }
            case 'PATCH':
            case 'PUT':
            {
                return [
                    'name' => 'required|string|min:2',
                    'photo'=>'image|mimes:jpeg,bmp,png|max:4096|nullable'
                ];
            }
            default:break;
        }
    }

    public function messages()
    {
        return [
            'name.required' => 'name is required!',
            'photo.required' => 'photo is required!',
            'photo.image' => 'photo is image!'
        ];
    }

}


