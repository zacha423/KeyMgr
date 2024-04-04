<x-adminlte-modal id="updateGroupModal" :title="$title" theme="info" v-centered>
  <form id="updateGroupForm" method="POST" action="{{ route('groups.update', ['group' =>$group['id']]) }}">
    @csrf
    @method('patch')
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
      <x-adminlte-input name="groupName" :value="old('name', $group['name'])" label="Edit Group Name"/>
      
    </div>
    <x-slot name="footerSlot">
      <x-adminlte-button class="mr-auto" type="submit" theme="success" label="Submit" form="updateGroupForm"/>
      <x-adminlte-button label="Cancel" theme="danger" data-dismiss="modal"/>
    </x-slot>
  </form>
</x-adminlte-modal>