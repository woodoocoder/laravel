<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User\OptionsResource;
use App\Http\Resources\User\InformationResource;
use Storage;

class UserResource extends JsonResource{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) {
        return [
            'id' => $this->id,
            'firstname' => $this->firstname,
            'middlename' => $this->middlename,
            'lastname' => $this->lastname,
            'avatar_url' => Storage::url('avatars/'.$this->id.'/'.$this->avatar),
            'last_activity' => $this->last_activity,
            'options' => new OptionsResource($this->options),
            'information' => new InformationResource($this->information),
        ];
    }
}
