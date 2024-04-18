<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RoomSelector extends Component
{
  /**
   * Create a new component instance.
   */
  public function __construct(
    public string $id = "",
    public mixed $options = [],
    public mixed $selected = [],
    public bool $multiple = false
  ) {
    //
  }

  /**
   * Get the view / contents that represent the component.
   */
  public function render(): View|Closure|string
  {
    return view('components.room-selector');
  }
}
