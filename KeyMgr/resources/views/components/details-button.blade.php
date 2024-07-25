<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
use App\View\Components\DetailsButton;
?>
<div>
    <a href="{{$route}}" class="btn btn-xs btn-default text-teal mx-1 shadow" title="{{DetailsButton::TITLE}}">
      <i class="{{DetailsButton::FA_ICON}}"></i>
    </a>
</div>