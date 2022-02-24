<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class VisitaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $response = parent::toArray($request);
        Arr::set($response, 'fecha_modificacion', $this->fecha_modificacion->format('d-m-Y H:i'));
        Arr::set($response, 'fecha_registro', $this->fecha_registro->format('d-m-Y H:i'));
        return $response;
    }

    public function with($request)
    {
        return [
            'status' => true
        ];
    }
}
