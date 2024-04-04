<div class="container-flex">
  <form id="modalForm" action="/groups/roles" method="post">
    @csrf
  <x-adminlte-modal :title="$title" id="roleModal" theme="info" v-centered>
    <x-adminlte-info-box title="Selected Users" text="a" icon-theme="info" icon="fas fa-user"/>
  <x-adminlte-input-switch id="addMode" name="addMode" label="Operation" :config="[
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
    <x-role-selector id="rSel" :options="$options" :selected="[]"></x-role-selector>
    <x-slot name="footerSlot">
      <x-adminlte-button id="saveRoles" class="mr-auto" type="submit" theme="success" label="Submit" form="modalForm"/>
      <x-adminlte-button label="Cancel" theme="danger" data-dismiss="modal"/>
    </x-slot>
  </x-adminlte-modal>
  </form>
</div>
<script>
  $(() =>{
    
    $('#roleModal').on('show.bs.modal', ($e) => {
      // Add # selected groups to info box in modal.
      $('#roleModal').find('.info-box-number')[0].innerHTML = getSelectedIDs('groupTable').length;

      // Add items to hidden select.
      $('#selectedGroups').remove();
      $('<select id="selectedGroups" name="selectedGroups[]" multiple hidden>').appendTo('#modalForm');
      $(() => {
        getSelectedIDs('groupTable').forEach(($id) => {
          $('<option selected />').attr('value', $id).appendTo('#selectedGroups');
        });
      });

      // Disable modal's submit button if no groups selected.
      $(() => {
        getSelectedIDs('groupTable').length === 0 ? $('#saveRoles').attr('disabled', true):$('#saveRoles').attr('disabled', false);
      })
    });

    
    
  });
</script>