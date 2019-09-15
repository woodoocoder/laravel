<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\UserResource;

class LikeResource extends JsonResource{

    protected $userId = null;

    public function userId($userId) {
        $this->userId = $userId;
        return $this;
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) {
        return [
            'id' => $this->id,
            'user' => new UserResource($this->user),
            'seen' => $this->seen,
        ];
    }
}
