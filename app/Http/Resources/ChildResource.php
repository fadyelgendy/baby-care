<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChildResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->getId(),
            "name" => $this->getName(),
            "age" => $this->getAge(),
            "gender" => $this->getGender(),
            "parent" => [
                "id" => $this->getParent()->getId(),
                "name" => $this->getParent()->getName(),
            ]
        ];
    }
}
