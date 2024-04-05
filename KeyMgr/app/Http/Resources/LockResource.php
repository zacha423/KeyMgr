<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LockResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @return array<string, mixed>
   */
  public function toArray(Request $request): array
  {
    $buildingID = $roomID = $building = $room = null;
    
    if ($this->door)
    {
      $room = $this->door->room->number;
      $building = $this->door->room->building->name;
    }

    return array_merge([
      'id' => $this->id,
      'numPins' => $this->numPins,
      'upperPinLengths' => $this->upperPinLengths,
      'lowerPinLengths' => $this->lowerPinLengths,
      'installDate' => $this->installDate,
      'keyway' => $this->keyway->name,
      'keyway_id' => $this->keyway->id,
      'room' => $room,
      'room_id' => $roomID,
      'building_id' => $buildingID,
      'building' => $building,
      'door' => $this->door->number,
      'lockmodel_id' => $this->model->id,
    ], (new LockModelResource($this->lockModel))->toArray($request));
  }
}
