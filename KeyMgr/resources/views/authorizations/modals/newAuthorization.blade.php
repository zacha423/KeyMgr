<x-adminlte-modal id="newAuthModal" title="Create New Key Authorization" theme="lightblue" v-centered scrollable>
  <form id="newAuth" action="{{ route('authorizations.store') }}" method="POST">
    @csrf
    <x-slot name="footerSlot">
      <x-adminlte-button type="submit" class="block mr-auto" theme="success" label="Add Authorization" form="newAuth"/>
      <x-adminlte-button type="button" class="block ml-auto" theme="danger" label="Cancel" data-dismiss="modal"/>
    </x-slot>
  </form>
</x-adminlte-modal>