<div class="container-flex">
  <x-adminlte-modal :title="$title" :id="$id" theme="info" v-centered>
    <form id="modalForm" action="{{$submitURL}}" method="post">
      @csrf
      
      {{-- A basic textbox listing the number of users to operate on.  --}}
      <div class="row">
        <x-adminlte-info-box title="Selected Users" text="a" icon-theme="info" icon="fas fa-user"/>
      </div>

      <div class="row"><div class="col">
        {{-- The name has to be different on each switch? --}}
        <x-adminlte-input-switch :id="'sw'.$id" name="additionMode" label="Operation" :config="[
          'onColor' => 'green',
          'offColor' => 'red',
          'onText' => 'Add',
          'offText' => 'Remove',
          'animate' => true,
          ]" theme="info">    
          <x-slot name="prependSlot">
            <div class="input-group-text bg-info">
              <i class="fas fa-toggle-on"></i>
            </div>
          </x-slot>
        </x-adminlte-input-switch>
      </div></div>
      <div class="row">
        <div class="col">
          <x-adminlte-select id="modalSelector" name="selectedData[]" :label="$selectName" multiple>
            <x-slot name="prependSlot">
              <div class="input-group-text bg-info">
                <i class="fas fa-users"></i>
              </div>
            </x-slot>
            <x-adminlte-options :options="$options"/>
            {{--<x-slot name="appendSlot"> 
              <x-adminlte-button theme="outline-dark" label="Clear" icon="fas fa-lg fa-ban text-danger"/> 
            </x-slot>--}}
          </x-adminlte-select>
        </div>
      </div>
    </form>
    <x-slot name="footerSlot">
      <x-adminlte-button id="submitModal" type="submit" class="mr-auto" label="Save" theme="success" form='modalForm'/>
      <x-adminlte-button label="Cancel" theme="danger" data-dismiss='modal'/>
    </x-slot>
  </x-adminlte-modal>
</div>

<script>
  $(()=>{
    $('#' + '<?php echo $id ?>' ).on('show.bs.modal', ($e)=>{
      // Calculate the number of selected users.
      $('#' + '<?php echo $id ?>').find('.info-box-number')[0].innerHTML = getSelectedIDs('table5').length;

      // Add a hidden select to hold selected user IDs.
      $('<select id="selectedUsers" name="selectedUsers[]" multiple hidden >').appendTo('#modalForm');
      // Load each user ID into the hidden select.
      $(()=>{getSelectedIDs('table5').forEach(($ID)=>{
          $('<option selected />').attr('value', $ID).appendTo('#selectedUsers');
        });
      });

      // Disable submit button if no users are selected.
      $(()=> {
        getSelectedIDs('table5').length === 0 ? $('#submitModal').attr('disabled', true):$('#submitModal').attr('disabled',false);
      });
    });
  })
</script>