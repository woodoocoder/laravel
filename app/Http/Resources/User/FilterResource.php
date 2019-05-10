<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\User\SearchReasonResource;

/**
 *   @OA\Schema(
 *   schema="UserFilter",
 *   type="object",
 *   allOf={
 *       @OA\Schema(
 *           @OA\Property(property="id", format="integer", type="integer"),
 *           @OA\Property(property="reason", type="object",
 *              allOf={
 *                  @OA\JsonContent(ref="#/components/schemas/UserSearchReason")
 *              }
 *           ),
 *           @OA\Property(property="gender", type="string"),
 *           @OA\Property(property="age_from", type="integer"),
 *           @OA\Property(property="age_to", type="integer"),
 *           @OA\Property(property="city_id", type="integer"),
 *       )
 *   }
 * )
 */
class FilterResource extends JsonResource{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) {
        return [
            'id' => $this->id,
            'reason' => ($this->reason)? new SearchReasonResource($this->reason): null,
            'gender' => $this->gender,
            'age_from' => $this->age_from,
            'age_to' => $this->age_to,
            'city_id' => $this->city_id,
        ];
    }
}
