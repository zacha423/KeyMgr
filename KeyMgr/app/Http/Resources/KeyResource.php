<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KeyResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @return array<string, mixed>
   */
  public function toArray(Request $request): array
  {
    return [
      'id' => $this->id,
      'keyLevel' => $this->keyLevel,
      'keySystem' => $this->keySystem,
      'copyNumber' => $this->copyNumber,
      'bitting' => $this->bitting,
      'blindCode' => $this->blindCode,
      'mainAngles' => $this->mainAngles,
      'doubleAngles' => $this->doubleAngles,
      'repalcementCost' => $this->replacementCost,
      'status' => $this->status->name,
      'keyway' => $this->keyway->name,
      'type' => $this->type->name,
      'storageCabinet' => '',
      'storageHook' => '',
      'storageCabinetID' => $this->storage->key_storage_id,
      'storageHookID' => $this->storage->id,
    ];
  }
}
