<div class="container-flex">
  <form id="manageGroupsForm" action="/roles/groups" method="post">
    @csrf 
    <x-adminlte-modal title="Group Memership Managegment" id="groupsModal" theme="info" v-centered>
      <x-adminlte-info-box title="Selected Roles" text="a" icon-theme="info" icon="fas fa-user"/>
      @php
      $config = [
        'onColor' => 'green',
        'offColor' => 'red',
        'onText' => 'Add',
        'offText' => 'Remove',
        'animate' => true,
      ];
      @endphp
      <x-adminlte-input-switch id="addMode" name="addMode" label="Operation" :config="$config">
        <x-slot name="prependSlot">
          <div class="input-group-text bg-info">
            <i class="fas fa-toggle-on"></i>
          </div>
        </x-slot>
      </x-adminlte-input-switch>
      <x-group-selector id="gSel" :options="$options" :selected="[]"></x-group-selector>
      <x-slot name="footerSlot">
        <x-adminlte-button id="saveGroups" class="mr-auto" type="submit" theme="success" label="Submit" form="manageGroupsForm"/>
        <x-adminlte-button label="Cancel" theme="danger" data-dismiss="modal"/>
      </x-slot>
    </x-adminlte-modal>
  </form>
</div>
<script>
  $(() => {
    $('#groupsModal').on('show.bs.modal', ($e) => {
      // Add # selected roles to info box in modal.
      $('#groupsModal').find('.info-box-number')[0].innerHTML = getSelectedIDs('table5').length;

      // Add items to hidden select.
      $('#selectedRoles').remove();
      $('<select id="selectedRoles" name="selectedRoles[]" multiple hidden/>').appendTo('#groupsModal');
      $(() => {
        getSelectedIDs('table5').forEach (($id) => {
          $('<option selected />').attr('value', $id).appendTo('#selectedRoles');
        });
      });

      // Disable modal's submit button if no roles selected.
      $(() => {
        getSelectedIDs('table5').length === 0 ? $('#saveGroups').attr('disabled', true):$('#saveGroups').attr('disabled', false);
      })
    })
  });
</script>