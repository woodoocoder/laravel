<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\User\SearchReasonResource;

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
