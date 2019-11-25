<?php

namespace App\Http\Requests\Collaborators;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3|max:200',
            'email' => 'required|email|max:90|unique:colaborators,email',
            'city_id' => 'required|numeric|exists:cities,id',
            'role_id' => 'required|numeric|exists:roles,id',
        ];
    }
}
