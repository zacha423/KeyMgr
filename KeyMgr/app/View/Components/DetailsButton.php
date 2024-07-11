<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DetailsButton extends Component
{
  const FA_ICON = "fa fa-lg fa-fw fa-eye";
  const TITLE = "Details";
  /**
   * Create a new component instance.
   */
  public function __construct(public string $route)
  {
    //
  }

  /**
   * Get the view / contents that represent the component.
   */
  public function render(): View|Closure|string
  {
    return view('components.details-button');
  }
}
