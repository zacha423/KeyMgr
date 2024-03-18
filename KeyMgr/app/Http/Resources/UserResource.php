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
    $roles = [];
    $groups = [];
    foreach ($this->roles()->get() as $role) {
      array_push($roles, (new RoleResource($role))->name);
    }
    foreach ($this->groups()->get() as $group) {
      array_push ($groups, (new GroupResource($group))->name);
    }
    
    return [
      'id' => $this->id,
      'name' => $this->getFullname(),
      'firstName' => $this->firstName,
      'lastName' => $this->lastName,
      'email' => $this->email,
      'username' => $this->username,
      'created' => $this->created_at,
      'updated' => $this->updated_at,
      'roles2' => $roles,
      'groups2' => $groups,
    ];
  }
}
