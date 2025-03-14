<x-adminlte-modal id="campusForm" title="Campus Creation Form" theme="lightblue" size="sm1" 
                  v-centered static-backdrop scrollable>
  <div>
    <form id="newCampus" action="/campus" method="POST">
      @csrf

      {{-- Name field --}}
      <div class="input-group mb-3">
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
              value="{{ old('name') }}" placeholder="{{ __('adminlte::adminlte.campus_name') }}" autofocus>
        <div class="input-group-append">
          <div class="input-group-text">
              
          </div>
        </div>
        @error('name')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>

      {{-- Country field --}}
      <div class="input-group mb-3">
        <input type="text" name="country" class="form-control @error('country') is-invalid @enderror"
              value="{{ old('country') }}" placeholder="{{ __('adminlte::adminlte.country') }}" autofocus>
        <div class="input-group-append">
          <div class="input-group-text">
              
          </div>
        </div>
        @error('country')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>

      {{-- State field --}}
      <div class="input-group mb-3">
        <input type="text" name="state" class="form-control @error('state') is-invalid @enderror"
              value="{{ old('state') }}" placeholder="{{ __('adminlte::adminlte.state') }}" autofocus>
        <div class="input-group-append">
          <div class="input-group-text">
              
          </div>
        </div>
        @error('state')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>

      {{-- City field --}}
      <div class="input-group mb-3">
        <input type="text" name="city" class="form-control @error('city') is-invalid @enderror"
              value="{{ old('city') }}" placeholder="{{ __('adminlte::adminlte.city') }}" autofocus>
        <div class="input-group-append">
          <div class="input-group-text">
              
          </div>
        </div>
        @error('city')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>

      {{-- Street field --}}
      <div class="input-group mb-3">
        <input type="text" name="streetAddress" class="form-control @error('streetAddress') is-invalid @enderror"
              value="{{ old('streetAddress') }}" placeholder="{{ __('adminlte::adminlte.streetAddress') }}" autofocus>
        <div class="input-group-append">
          <div class="input-group-text">
              
          </div>
        </div>
        @error('streetAddress')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>

      {{-- Zip field --}}
      <div class="input-group mb-3">
        <input type="text" name="postalCode" class="form-control @error('postalCode') is-invalid @enderror"
              value="{{ old('postalCode') }}" placeholder="{{ __('adminlte::adminlte.postalCode') }}" autofocus>
        <div class="input-group-append">
          <div class="input-group-text">
              
          </div>
        </div>
        @error('postalCode')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>

      <x-slot name="footerSlot">
        <x-adminlte-button type="submit" class="block mr-auto" theme="success" label="Add Campus" form="newCampus"/>
        <x-adminlte-button type="button" class="block ml-auto" theme="danger" label="Cancel" data-dismiss="modal"/>
      </x-slot>  
    </form>
  </div>
</x-adminlte-modal>