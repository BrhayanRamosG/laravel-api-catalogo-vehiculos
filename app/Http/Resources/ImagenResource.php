<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class ImagenResource extends JsonResource
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
        Arr::set($response, 'fecha_registro', $this->fecha_registro->format('d-m-Y H:i'));
        //$response = Arr::add($response, 'fecha_registro', $this->created_at->format('d-m-Y H:i'));
        return $response;
    }

    public function with($request)
    {
        return [
            'status' => true
        ];
    }
}
