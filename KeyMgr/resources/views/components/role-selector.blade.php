<div>
@php
  $selectConfig = [
    "title" => "Select roles...",
    "liveSearch" => true,
    "liveSearchPlaceholder" => "Search...",
    "showTick" => true,
    "actionsBox" => true,
  ];
  @endphp
  <x-adminlte-select-bs :id="$id" name="roles[]" label="Roles" 
    label-class="text-info" :config="$selectConfig" multiple enable-old-support>
    <x-slot name="prependSlot">
      <div class="input-group-text bg-gradient-lightblue">
        <i class="fas fa-tag"></i>
      </div>
    </x-slot>
    <x-adminlte-options :options="$options" :selected="$selected"/>
  </x-adminlte-select-bs>
</div>