<x-adminlte-modal id="updateRoleModal" :title="$title" theme="info" v-centered>
  <form id="updateRoleForm" method="POST" action="{{ route('roles.update', ['role' =>$role['id']]) }}">
    @csrf
    @method('patch')
    <div class="col">


      {{-- Role Name Input --}}
      <x-adminlte-input name="roleName" :value="old('name', $role['name'])" label="Edit Role Name"/>
      
    </div>
    <x-slot name="footerSlot">
      <x-adminlte-button class="mr-auto" type="submit" theme="success" label="Submit" form="updateRoleForm"/>
      <x-adminlte-button label="Cancel" theme="danger" data-dismiss="modal"/>
    </x-slot>
  </form>
</x-adminlte-modal>