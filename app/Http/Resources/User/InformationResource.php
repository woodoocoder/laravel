<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class InformationResource extends JsonResource{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) {
        return [
            'relationship' => $this->relationship->name,
            'living' => $this->living->name,
            'children' => $this->children->name,
            'smoking' => $this->smoking->name,
            'drinking' => $this->drinking->name,
        ];
    }
}
