<x-adminlte-modal id="campusForm" :title="$formTitle" theme="lightblue" size="sm1" 
  v-centered static-backdrop scrollable>
  <div>
    <form id="newCampus" :action="$submitURL" :method="$submitMethod">
      @csrf

      {{-- AdminLTE Name Field --}}
      <x-adminlte-input name="name" label="{{ __('adminlte::adminlte.campus_name') }}" enable-old-support></x-adminlte-input>
      {{-- Append slot can hold the help toggle. Add a full help toggle to the top right corner.
      If there is no help text simply disable the toggle in off position
      bottomSlot can be used for the actual help text.
      https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Forms-Components#input
      --}}
      @error('name')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
      @enderror

      {{-- AdminLTE Country field --}}
      <x-adminlte-input name="country" label="{{ __('adminlte::adminlte.country') }}" enable-old-support></x-adminlte-input>
      @error('country')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
      @enderror

      {{-- AdmninLTE state field --}}
      <x-adminlte-input name="state" label="{{ __('adminlte::adminlte.state') }}" enable-old-support></x-adminlte-input>
      @error('state')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
      @enderror

      {{-- AdminLTE city field --}}
      <x-adminlte-input name="city" label="{{ __('adminlte::adminlte.city') }}" enable-old-support></x-adminlte-input>
      @error('city')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
      @enderror

      {{-- AdminLTE streetAddress field--}}
      <x-adminlte-input name="streetAddress" label="{{ __('adminlte::adminlte.streetAddress') }}" enable-old-support></x-adminlte-input>
      @error('streetAddress')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
      @enderror

      {{-- AdminLTE postalcode field --}}
      <x-adminlte-input name="postalCode" label="{{ __('adminlte::adminlte.postalCode') }}" enable-old-support></x-adminlte-input>
      @error('postalCode')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
      @enderror

      <x-slot name="footerSlot">
        <x-adminlte-button type="submit" class="block mr-auto" theme="success" label="Add Campus" form="newCampus" />
        <x-adminlte-button type="button" class="block ml-auto" theme="danger" label="Cancel" data-dismiss="modal" />
      </x-slot>
    </form>
  </div>
</x-adminlte-modal>