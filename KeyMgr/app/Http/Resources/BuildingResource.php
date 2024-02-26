<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */

 namespace App\Http\Resources;
 use Illuminate\Http\Request;
 use Illuminate\Http\Resources\Json\JsonResource;

 class BuildingResource extends JsonResource 
 {
  /**
   * @Transform the Building into an array
   * 
   * @return array<string, mixed>
   * 
   * @todo Add resource and resource collection for door @ZAG
   */
  public function toArray(Request $request): array
  {
    return [
      'id' => $this->id,
      'name'=> $this->name,
      'country' => $this->address->city->state->country->name,
      'state' => $this->address->city->state->name,
      'city' => $this->address->city->name,
      'postalCode' => $this->address->zipcode->code,
      'streetAddress' =>$this->address->streetAddress,
      'campus' => $this->campus->name,
      // 'rooms' => $this->rooms,/** @see the @todo  */
      'rooms' => RoomResource::collection($this->rooms),
    ];
  }
 }