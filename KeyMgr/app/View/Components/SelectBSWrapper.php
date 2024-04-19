<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use phpDocumentor\Reflection\PseudoTypes\LowercaseString;

class SelectBSWrapper extends Component
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
    public string $faicon,
    public mixed $config,
    public bool $multiple,
  ) {
    // 
  }

  /**
   * Get the view / contents that represent the component.
   */
  public function render(): View|Closure|string
  {
    return view('components.select-bs-wrapper');
  }
}
