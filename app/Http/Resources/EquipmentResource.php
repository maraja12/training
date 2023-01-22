<?php

namespace App\Http\Resources\Equipment;

use Illuminate\Http\Resources\Json\JsonResource;

class EquipmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public static $wrap = 'equipment';

    public function toArray($request)
    {
        return [
            'weight' => $this->resource->weight,
            'storage' => $this->resource->storage,
            'usage' => $this->resource->usage
        ];
    }
}
