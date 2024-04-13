<div class="container-flex">
{{-- Should use: route('keys.massAssign') --}}  
<form id="assignKey" action="{{ route('keys.massassign') }}" method="POST">
    @csrf
<x-adminlte-modal id="usersForm" title="Assign Key" theme="lightblue" v-centered>
  <x-adminlte-info-box title="Selected Keys" text="a" icon-theme="info" icon="fas fa-key"/>
  <x-select-bs-wrapper id="userSelect" name="user" label="Key Holder" :options="$users" :selected="[]" faicon="fas fa-key" :config="[]" multiple=""/>
  <x-slot name="footerSlot">
    <x-adminlte-button id="saveAssignments" class="mr-auto" type="submit" theme="success" label="Submit" form="assignKey"/>
    <x-adminlte-button label="Cancel" theme="danger" data-dismiss="modal"/>
  </x-slot>
</x-adminlte-modal>
</form>
</div>