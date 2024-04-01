<?php

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
    return [
      'numPins' => $this->numPins,
      'upperPinLengths' => $this->upperPinLengths,
      'lowerPinLengths' => $this->lowerPinLengths,
      'installDate' => $this->installDate,
      'keyway' => $this->keyway()->get()->name,
    ];
  }
}
