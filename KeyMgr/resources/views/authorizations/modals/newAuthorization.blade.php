<x-adminlte-modal id="newAuthModal" title="Create New Key Authorization" theme="lightblue" v-centered scrollable size="lg">
  <form id="newAuth" action="{{ route('authorizations.store') }}" method="POST">
    @csrf
    <div class="row">
      <div class="col">
      <x-adminlte-card><div class="row"><div class="col">
        <x-user-selector id="holderSel_create" name="holderSel_create" label="Key Holder" :options="$allHolders"/>
      </div>
      <div class="col">
        <x-user-selector id="requestorSel_create" name="requestorSel_create" label="Key Requestor" :options="$allRequestors"/>
      </div></div></x-adminlte-card>
    </div></div>
    <div class="row">
      <div class="col">
        <x-adminlte-card>
          <x-room-selector id="modal" :options="$buildings"/>
        </x-adminlte-card>
      </div>
    </div>
  
    <x-slot name="footerSlot">
      <div class="container">
        <div class="row">
            <div class="col-4 d-flex">
              {{-- 'class="btn-block"' - Bootstrap 4 go brr ... why no BS5? --}}
              <x-adminlte-button class="btn-block" type="submit" theme="success" label="Submit Authorization" form="newAuth"/>
            </div>
            <div class="col-4 d-flex">
              <x-adminlte-button class="btn-block" id="addRoom" type="button" theme="primary" disabled label="Add Additional Room"/>  
            </div>
            <div class="col-4 d-flex">
              <x-adminlte-button class="btn-block" type="button" theme="danger" label="Cancel" data-dismiss="modal"/>
            </div>
        </div>
      </div>
    </x-slot>
  </form>
</x-adminlte-modal>