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
   */
  public function toArray(Request $request): array
  {
    return [
      'id' => $this->id,
      'name'=> $this->name,
    ];
  }
 }