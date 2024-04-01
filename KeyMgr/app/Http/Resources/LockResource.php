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
    return array_merge([
      'numPins' => $this->numPins,
      'upperPinLengths' => $this->upperPinLengths,
      'lowerPinLengths' => $this->lowerPinLengths,
      'installDate' => $this->installDate,
      'keyway' => $this->keyway->name,
      'keyway_id' => $this->keyway->id,

    ], (new LockModelResource($this->lockModel))->toArray($request));
  }
}
