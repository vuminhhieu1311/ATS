<?php

namespace App\Http\Resources;

use App\Http\Resources\Custom\ShareResource;

class PermissionResource extends ShareResource
{
    /**
     * Transform the resource into an array.
     *
     * @var  \Illuminate\Http\Request  $request
     *
     * @return array
     */
    public function toArray($request) // @codingStandardsIgnoreLine
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'guardName' => $this->guard_name,
            'users' => UserResource::collection($this->users),
            'roles' => RoleResource::collection($this->roles),
        ];
    }
}
