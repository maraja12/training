<?php

namespace App\Http\Resources\Training;

use Illuminate\Http\Resources\Json\JsonResource;

class TrainingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public static $wrap = 'training';

    public function toArray($request)
    {
        return [
            'name' => $this->resource->name,
            'coach' => new CoachResource($this->resource->coach),
            'equipment' => new EquipmentResource($this->resource->equipment),
            'level' => $this->resource->level,
            'gender' => $this->resource->gender
        ];
    }
}
