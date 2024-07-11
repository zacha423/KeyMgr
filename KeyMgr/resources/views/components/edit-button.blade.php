<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
use App\View\Components\EditButton;
?>
<div>
  <a href="{{$route}}" class="btn btn-xs btn-default text-primary mx-1 shadow" title="{{EditButton::TITLE}}">
    <i class="{{EditButton::FA_ICON}}"></i>
  </a>
</div>