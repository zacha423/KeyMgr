<div>
  @php
  $baseConfig = [
    'title' => "Select " . strtolower($label) . "...",
    'liveSearch' => true,
    'liveSearchPlaceholder' => 'Search...',
    'showTick' => true,
    'actionsBox' => true,
  ];
  $config = array_merge($baseConfig, $config);
  @endphp

  <x-adminlte-select-bs 
    :id="$id" 
    :name="$name" 
    :label="$label" 
    label-class="text-info" 
    multiple 
    enable-old-support 
    :config="$config"
  >
    {{-- Only add icon if specified --}}
    @if(!empty($faicon))
      <x-slot name="prependSlot">
        <div class="input-group-text bg-gradient-lightblue">
          <i class="{{$faicon}}"></i>
        </div>
      </x-slot>
    @endif

    <x-adminlte-options :options="$options" :selected="$selected"/>
  </x-adminlte-select-bs>
</div>