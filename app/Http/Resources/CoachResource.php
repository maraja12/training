<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CoachResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    public static $wrap = 'coach';

    public function toArray($request)
    {
        return [
            'name' => $this->resource->name,
            'age' => $this->resource->age,
            'experience' => $this->resource->experience,
        ];
    }
}
