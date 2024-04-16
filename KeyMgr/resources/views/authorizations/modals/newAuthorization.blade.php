<x-adminlte-modal id="newAuthModal" title="Create New Key Authorization" theme="lightblue" v-centered scrollable>
  <form id="newAuth" action="{{ route('authorizations.store') }}" method="POST">
    @csrf
    <div class="row">
      <div class="col">
        <x-user-selector id="holderSel" name="holderSel" label="Key Holder" :options="[]" :selected="[]" multiple=""/>
      </div>
      <div class="col">
        <x-user-selector id="requestorSel" name="requestorSel" label="Key Requestor" :options="[]" :selected="[]" multiple=""/>
      </div>
    </div>
    <div class="row">
      <div class="col"><x-room-selector></x-room-selector></div>
    </div>
    <div class="row">
      
    </div>
    <x-slot name="footerSlot">
      <div class="col">
      <x-adminlte-button type="submit" class="block mr-auto" theme="success" label="Add Authorization" form="newAuth"/>
</div>
  <div clasa="col">
      <x-adminlte-button id="addRoom" type="button" theme="primary" disabled label="Add Additional Room"/>  
</div>

<diV class="col ">
      <x-adminlte-button class="btn=block " type="button" theme="danger" label="Cancel" data-dismiss="modal"/>
      
</div>
    </x-slot>
  </form>
</x-adminlte-modal>