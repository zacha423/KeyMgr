<x-adminlte-modal id="newRoleModal" :title="$title" theme="info" v-centered>
  <form id="newRoleForm" action="/groups" method="POST">
    @csrf
    <div class="col">

      {{-- Role Name Input --}}
      <x-adminlte-input name="roleName" placeholder="Enter role name" label="Role Name"/>
      
    </div>
    <x-slot name="footerSlot">
      <x-adminlte-button class="mr-auto" type="submit" theme="success" label="Submit" form="newRoleForm"/>
      <x-adminlte-button label="Cancel" theme="danger" data-dismiss="modal"/>
    </x-slot>
  </form>
</x-adminlte-modal>