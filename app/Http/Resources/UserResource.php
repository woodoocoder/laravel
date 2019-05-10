<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User\OptionsResource;
use App\Http\Resources\User\InformationResource;
use App\Http\Resources\User\FilterResource;
use Storage;

/**
 *   @OA\Schema(
 *   schema="User",
 *   type="object",
 *   allOf={
 *       @OA\Schema(
 *           @OA\Property(property="id", format="integer", type="integer"),
 *           @OA\Property(property="middlename", format="string", type="string"),
 *           @OA\Property(property="lastname", format="string", type="string"),
 *           @OA\Property(property="avatar_url", format="string", type="string"),
 *           @OA\Property(property="last_activity", format="date-time", type="string"),
 *           @OA\Property(property="options", type="object",
 *              allOf={
 *                  @OA\JsonContent(ref="#/components/schemas/UserOptions")
 *              }
 *           ),
 *           @OA\Property(property="information", type="object",
 *              allOf={
 *                  @OA\JsonContent(ref="#/components/schemas/UserInformation")
 *              }
 *           ),
 *           @OA\Property(property="filters", type="object",
 *              allOf={
 *                  @OA\JsonContent(ref="#/components/schemas/UserFilter")
 *              }
 *           ),
 *       )
 *   }
 * )
 */
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
            'filters' => new FilterResource($this->filters),
        ];
    }
}
