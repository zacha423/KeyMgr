<?php
/**
 * @author Zachary Abela-Gale <abel1325@Pacificu.edu>
 */
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LockModelResource extends JsonResource
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
      'MACS' => $this->MACS,
      'name' => $this->name,
      'manufacturer' => $this->manufacturer->name,
      'manufacturer_id' => $this->manufacturer->id,
    ];
  }
}
