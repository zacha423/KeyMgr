<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GroupResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @return array<string, mixed>
   */
  public function toArray(Request $request): array
  {
    $parent = null;

    if ($this->parent)
    {
      $parent = $this->parent->name;
    }

    return [
      'id' => $this->id,
      'name' => $this->name,
      'parentName' => $parent,
    ];
  }
}
