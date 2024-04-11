<x-adminlte-modal id="newGroupModal" :title="$title" theme="info" v-centered>
  <form id="newGroupForm" action="/groups" method="POST">
    @csrf
    <div class="col">
      {{-- Parent Group Select --}}
      <x-adminlte-select name="parentGroup" label="Parent Group" label-class="info">
        <x-slot name="prependSlot">
          <div class="input-group-text bg-primary">
            <i class="fas fa-users"></i>
          </div>
        </x-slot>
        <x-adminlte-options :options="$options"/>
      </x-adminlte-select>

      {{-- Group Name Input --}}
      <x-adminlte-input name="groupName" placeholder="Enter group name" label="Group Name"/>
      
    </div>
    <x-slot name="footerSlot">
      <x-adminlte-button class="mr-auto" type="submit" theme="success" label="Submit" form="newGroupForm"/>
      <x-adminlte-button label="Cancel" theme="danger" data-dismiss="modal"/>
    </x-slot>
  </form>
</x-adminlte-modal>
