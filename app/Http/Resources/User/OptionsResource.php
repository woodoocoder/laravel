<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 *   @OA\Schema(
 *   schema="UserOptions",
 *   type="object",
 *   allOf={
 *       @OA\Schema(
 *           @OA\Property(property="gender", format="string", type="string"),
 *           @OA\Property(property="birthday", format="date", type="string"),
 *           @OA\Property(property="country_id", format="integer", type="integer"),
 *           @OA\Property(property="region_id", format="integer", type="integer"),
 *           @OA\Property(property="city_id", format="integer", type="integer"),
 *       )
 *   }
 * )
 */
class OptionsResource extends JsonResource{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) {
        return [
            'id' => $this->id,
            'gender' => $this->gender,
            'birthday' => $this->birthday,
            'country_id' => $this->country_id,
            'region_id' => $this->region_id,
            'city_id' => $this->city_id,
        ];
    }
}
