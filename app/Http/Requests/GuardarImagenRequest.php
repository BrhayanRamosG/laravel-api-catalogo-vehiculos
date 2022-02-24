<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuardarImagenRequest extends FormRequest
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
            "Vehiculo_idVehiculo" => "required",
            "imagen" => "required",
            "imagen.*" => "required|image|mimes:jpeg,png|max:10000",
            "categoria" => "required"
        ];
    }
}
