<div class="container-flex">
  <form action="/groups/roles" method="post">
  <x-adminlte-modal :title="$title" id="roleModal" theme="info" v-centered>
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
      <x-adminlte-button class="mr-auto" type="submit" theme="success" label="Save" form="roleForm"/>
      <x-adminlte-button label="Cancel" theme="danger" data-dismiss="modal"/>
    </x-slot>
  </x-adminlte-modal>
  </form>
</div>