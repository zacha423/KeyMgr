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
  public const FA_ICON = "fa fa-lg fa-fw fa-pen";
  public const TITLE = "Edit";
  
  // deeets?
  public $route;
  public $formID;
  public $itemID;
  
  /**
   * Create a new component instance.
   */
  public function __construct(string $route = null, string $formID = null, string $itemID = null)
  {
    $this->route = $route;
    $this->formID = $formID;
    $this->itemID = $itemID;
  }

  /**
   * Get the view / contents that represent the component.
   */
  public function render(): View|Closure|string
  {
    return view('components.edit-button');
  }
}
