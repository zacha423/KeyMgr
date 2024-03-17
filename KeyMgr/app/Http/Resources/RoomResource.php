<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoomResource extends JsonResource
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
      'number' => $this->number,
      'description' => $this->description,
      'buildingID' => $this->building->id,
      'buildingName' => $this->building->name,
      'doorDesc' => $this->doors->first()->description,
      'doorHWDesc' => $this->doors->first()->hardwareDescription,
    ];
  }
}