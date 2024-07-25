<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Breadcrumb extends Component
{
  /**
   * Create a new component instance.
   */
  public function __construct(public mixed $crumbs)
  {
    // crumbs should be an array of dictionaries. 
    // Each dictionary should have a 'text' and 'link' key. 
    // The 'link' key may be null.
  }

  /**
   * Get the view / contents that represent the component.
   */
  public function render(): View|Closure|string
  {
    return view('components.breadcrumb');
  }
}
