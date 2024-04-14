<?php
/**
 * @author Zachary Abela-Gale
 */
namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UserSelector extends Component
{
  /**
   * Create a new component instance.
   */
  public function __construct(
    public string $id,
    public string $name,
    public string $label,
    public mixed $options,
    public mixed $selected,
    public bool $multiple
  ) {
    //
  }

  /**
   * Get the view / contents that represent the component.
   */
  public function render(): View|Closure|string
  {
    return view('components.user-selector');
  }
}
