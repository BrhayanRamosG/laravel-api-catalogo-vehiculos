<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InicioLoginRequest extends FormRequest
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
            "usuario" => "required|min:3|max:7",
            "password" => "required|min:8",
        ];
    }
}