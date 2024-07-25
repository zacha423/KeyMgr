<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EditButton extends Component
{
  const FA_ICON = "fa fa-lg fa-fw fa-pen";
  const TITLE = "Edit";
  
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
    return view('components.edit-button');
  }
}
