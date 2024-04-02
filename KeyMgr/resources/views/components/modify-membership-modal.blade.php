<form>
  <div class="flex-container">
    <x-adminlte-modal :title="$title" :id="$id" theme="info" v-centered>
      {{-- The name has to be different on the switch? --}}
      <div class="row">
        <x-adminlte-info-box title="Selected Users" text="a" theme="info"
        icon="fas fa-user"/>
      </div>
      <div class="row">
        <x-adminlte-input-switch :name="'operationSwitch'.$id" label="Operation" :config="[
          'onColor' => 'green',
          'offColor' => 'red',
          'onText' => 'Add',
          'offText' => 'Remove',
          'animate' => true,
          'state' => true,
          ]">    
          <x-slot name="prependSlot">
            <div class="input-group-text bg-lightblue">
              <i class="fas fa-toggle-on"></i>
            </div>
          </x-slot>
        </x-adminlte-input-switch>
      </div>
      <div class="row">
        <x-adminlte-select :name="$selectName" :label="$selectName" multiple theme="info">
          <x-slot name="prependSlot">
            <div class="input-group-text bg-gradient-info">
              <i class="fas fa-users"></i>
            </div>
          </x-slot>
          <x-adminlte-options :options="$options"/>
        </x-adminlte-select>
      </div>
    </x-adminlte-modal>
  </div>
</form>

<script>
  $('#addGroup').on('click', ($e)=>{

  });
</script>