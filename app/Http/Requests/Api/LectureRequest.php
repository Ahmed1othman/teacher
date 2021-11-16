<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;


class LectureRequest extends FormRequest
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
                    'name' => 'required|string|min:2',
                    'type' => 'required|in:single,group',
                    'month'=>'required|integer|min:1|max:12',
                    'time' => 'required',
                    'category_id'=>'required|exists:categories,id,deleted_at,NULL',
                    'photo'=>'required|image|mimes:jpeg,bmp,png|max:4096'
                ];
            }
            case 'PATCH':
            case 'PUT':
            {
                return [
                    'name' => 'required|string|min:2',
                    'type' => 'required|in:single,group',
                    'time' => 'required',
                    'month'=>'required|integer|min:1|max:12',
                    'category_id'=>'required|exists:categories,id,deleted_at,NULL',
                    'photo'=>'required|image|mimes:jpeg,bmp,png|max:4096'
                ];
            }
            default:break;
        }
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(responseFail('Validation Error', 401, $errors));
    }

}


