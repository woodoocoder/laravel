<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\User\InfoOptionResource;

/**
 *   @OA\Schema(
 *   schema="UserInformation",
 *   type="object",
 *   allOf={
 *       @OA\Schema(
 *           @OA\Property(property="relationship", type="object",
 *              allOf={
 *                  @OA\JsonContent(ref="#/components/schemas/UserInfoOption")
 *              }
 *           ),
 *           @OA\Property(property="living", type="object",
 *              allOf={
 *                  @OA\JsonContent(ref="#/components/schemas/UserInfoOption")
 *              }
 *           ),
 *           @OA\Property(property="children", type="object",
 *              allOf={
 *                  @OA\JsonContent(ref="#/components/schemas/UserInfoOption")
 *              }
 *           ),
 *           @OA\Property(property="smoking", type="object",
 *              allOf={
 *                  @OA\JsonContent(ref="#/components/schemas/UserInfoOption")
 *              }
 *           ),
 *           @OA\Property(property="drinking", type="object",
 *              allOf={
 *                  @OA\JsonContent(ref="#/components/schemas/UserInfoOption")
 *              }
 *           ),
 *       )
 *   }
 * )
 */
class InformationResource extends JsonResource{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) {
        return [
            'relationship' => ($this->relationship)?
                new InfoOptionResource($this->relationship): null,
            'living' => ($this->living)?
                new InfoOptionResource($this->living): null,
            'children' => ($this->children)?
                new InfoOptionResource($this->children): null,
            'smoking' => ($this->smoking)?
                new InfoOptionResource($this->smoking): null,
            'drinking' => ($this->drinking)?
                new InfoOptionResource($this->drinking): null,
        ];
    }
}
