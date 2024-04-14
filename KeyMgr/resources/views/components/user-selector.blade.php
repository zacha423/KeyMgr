{{-- Basic component for selecting 1, or more, users. --}}
<div>
  @php
  $selectConfig = [
    'title' => "Select " . strtolower($label) . "...",
    'liveSearch' => true,
    'liveSearchPlaceholder' => 'Search...',
    'showTick' => true,
    'actionsBox' => true,
  ];
  @endphp

  <x-adminlte-select-bs :id="$id" :name="$name" :label="$label" label-class="text-info" :multiple="$multiple" enable-old-support :config="$selectConfig">
    <x-slot name="prependSlot">
      <div class="input-group-text bg-gradient-lightblue">
        <i class="fas fa-user"></i>
</div>
</x-slot>

<x-adminlte-options :options="$options" :selected="$selected"/>
  </x-adminlte-select-bs>
</div>