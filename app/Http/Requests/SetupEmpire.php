<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SetupEmpire extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->planets()->count() === 0;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'ruler_name'       => 'required|unique:rulers,name,'.auth()->user()->id.'|max:32',
            'home_planet_name' => 'required|max:32',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'ruler_name.unique' => 'The ruler name provided is already in use.',
        ];
    }
}
