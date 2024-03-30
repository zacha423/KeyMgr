<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @return array<string, mixed>
   */
  /**
   * @todo Q: Can attributes be limited based on policy or route?
   */
  public function toArray(Request $request): array
  { 
    return [
      'id' => $this->id,
      'name' => $this->getFullname(),
      'firstName' => $this->firstName,
      'lastName' => $this->lastName,
      'email' => $this->email,
      'username' => $this->username,
      'created' => $this->created_at,
      'updated' => $this->updated_at,
      'roles2' => array_column(RoleResource::collection($this->roles()->get())->toArray($request), 'name'),
      'groups2' => array_column(GroupResource::collection($this->groups()->get())->toArray($request), 'name'),
    ];
  }
}
