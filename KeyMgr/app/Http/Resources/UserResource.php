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
    // return parent::toArray($request);
    return [
      'id' => $this->id,
      'name' => $this->getFullname(),
      'email' => $this->email,
      'username' => $this->username,
      'created' => $this->created_at,
      'updated' => $this->updated_at,
    ];
  }
}
