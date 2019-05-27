<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;


/**
 *   @OA\Schema(
 *   schema="UserInfoOption",
 *   type="object",
 *   allOf={
 *       @OA\Schema(
 *           @OA\Property(property="id", format="integer", type="integer"),
 *           @OA\Property(property="name", format="string", type="string")
 *       )
 *   }
 * )
 */
class InfoOptionResource extends JsonResource{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->type['name'],
        ];
    }
}
