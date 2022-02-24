<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuardarVehiculoRequest extends FormRequest
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
            "precio" => "required",
            "tratoPrecio" => "required",
            "transmision" => "required",
            "kilometraje" => "required",
            "year" => "required",
            "descripcion" => "required",
            "Modelo_idModelo" => "required",
            "TipoVehiculo_idTipoVehiculo" => "required",
            "CondicionVehiculo_idCondicionVehiculo" => "required",
            "Propietario_idPropietario" => "required",
            "Categoria_idCategoria" => "required",
            "FormaPago_idFormaPago" => "required",
            "Login_idLogin" => "required",
            "fijo" => "required"
        ];
    }
}
