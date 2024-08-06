<?php
/**
 * @author Zachary Abela-Gale <abel1325@pacificu.edu>
 */
use App\View\Components\EditButton;
?>

<div>
  @if(isset ($route)) 
    {{-- Sample: <x-edit-button route="{{route('campus.edit', $row[0])}}"></x-edit-button>--}}
    <a href="{{$route}}" class="btn btn-xs btn-default text-primary mx-1 shadow btn-edit" title="{{EditButton::TITLE}}">
      <i class="{{EditButton::FA_ICON}}"></i>
    </a>
  @elseif(isset($formID))
    {{-- Sample: <x-edit-button formID="#editForm" :itemID="$row[0]"></x-edit-button>--}}
    <button data-toggle="modal" data-target="{{$formID}}" class="btn btn-xs btn-default text-primary mx-1 shadow btn-edit">
      <i class="{{EditButton::FA_ICON}}"></i>
    </button>
  @endif
</div>