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
  
  /**
   * The URL the button should send a request to.
   * @var 
   */
  public $route;
  /**
   * The form the button should open.
   * @var 
   */
  public $formID;
  
  /**
   * Create a new component instance.
   */
  public function __construct(string $route = null, string $formID = null)
  {
    $this->route = $route;
    $this->formID = $formID;
  }

  /**
   * Get the view / contents that represent the component.
   */
  public function render(): View|Closure|string
  {
    return view('components.edit-button');
  }
}
