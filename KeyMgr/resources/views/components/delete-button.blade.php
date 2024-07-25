<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
use App\View\Components\DeleteButton;
?>
<div>
  <button class="btn btn-xs btn-default text-danger mx-1 shadow btn-delete" 
          title="{{DeleteButton::TITLE}}" 
          {{$dataAttribute."=".$campusID}}
  >
    <i class="{{DeleteButton::FA_ICON}}"></i>
  </button>
</div>