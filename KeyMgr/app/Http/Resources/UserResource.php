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
            // TO DO: Add conditional attrib once RBAC configured / ready to implement.
            // Q: Can cond. attrib. be based on route?
            // for attrib: 
            // 'firstName' => $this->firstName,
            // 'lastName' => $this->lastName,
        ];
    }
}
