{{-- Basic component for selecting 1, or more, rooms given a building. --}}
@php
$baseConfig = [
  'liveSearch' => true,
  'liveSearchPlaceholder' => 'Search...',
  'showTick' => true,
  'actionsBox' => true,
];
@endphp
<div class="row">
  {{-- Building Div --}}
  <div class="col">
    <x-adminlte-select-bs
      id="{{ 'buildingSel' . $id}}"
      name="buildingSel"
      label="Building"
      label-class="text-info"
      enable-old-support
      :config="array_merge($baseConfig, ['title' => 'Select building...'])"
    >
      <x-slot name="prependSlot"><div class="input-group-text bg-gradient-lightblue"><i class="fas fa-building"></i></div></x-slot>
      <x-adminlte-options :options="$options" :selected="$selected"/>
    </x-adminlte-select-bs>
  </div>
  {{-- Room Div --}}
  <div class="col">
    <x-adminlte-select-bs 
      id="{{'roomSel' . $id}}" 
      name="roomSel[]" 
      label="Room" 
      label-class="text-info" 
      :multiple="$multiple" 
      enable-old-support 
      :config="array_merge ($baseConfig, ['title' => 'Select room...'])"
    >
      <x-slot name="prependSlot">
        <div class="input-group-text bg-gradient-lightblue">
          <i class="fas fa-door-closed"></i> {{-- fa-building --}}
        </div>
      </x-slot>
      <x-adminlte-options :options="$options" :selected="$selected"/>
    </x-adminlte-select-bs>
  </div>
  <script>
    $('#buildingSel' + '{{$id}}').change(() => {
      const IDs = $('#buildingSel' + '{{$id}}').val();
      $.ajax({
        type: "GET",
        url: "{{ route('getRooms') }}",
        data: {
          building_id: IDs
        },
        success: function (res) {
          if (res) {
            $('#roomSel' + '{{$id}}').html(res);
            $('#roomSel' + '{{$id}}').selectpicker('refresh');
          }
        }
      });
    });
  </script>
</div>