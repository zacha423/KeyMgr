
@extends ("adminlte::page")
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@section ("content")

<div class="col text-right">
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#campusForm">
        New Campus
      </button>
      </div>  

<x-adminlte-modal id="campusForm" title="Campus Creation Form" theme="lightblue" size="sm1" 
                  v-centered static-backdrop scrollable>
  <div>
    <form id="newCampus" action="/campus" method="POST">
      @csrf

      {{-- First Name field --}}
      <!-- <div class="input-group mb-3">
        <input type="text" name="firstName" class="form-control @error('firstName') is-invalid @enderror"
              value="{{ old('firstName') }}" placeholder="{{ __('adminlte::adminlte.first_name') }}" autofocus>
        <div class="input-group-append">
          <div class="input-group-text">
              <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
          </div>
        </div>
        @error('firstName')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>

      {{-- Last Name field --}}
      <div class="input-group mb-3">
        <input type="text" name="lastName" class="form-control @error('lastName') is-invalid @enderror"
              value="{{ old('lastName') }}" placeholder="{{ __('adminlte::adminlte.last_name') }}" autofocus>
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
          </div>
        </div>
        @error('lastName')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>

        {{-- Username field --}}
        <div class="input-group mb-3">
          <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" 
                value="{{ old('email') }}" placeholder="{{__('adminlte::adminlte.username') }}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope {{ config('adminlte.classes_auth_icon', '') }}"></span>
            </div>
          </div>
          @error('username')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>

        {{-- Email field --}}
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email') }}" placeholder="{{ __('adminlte::adminlte.email') }}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope {{ config('adminlte.classes_auth_icon', '') }}"></span>
            </div>
          </div>
          @error('email')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>

        {{-- Password field --}}
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                placeholder="{{ __('adminlte::adminlte.password') }}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
            </div>
          </div>
          @error('password')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>

        {{-- Confirm password field --}}
        <div class="input-group mb-3">
          <input type="password" name="password_confirmation"
                class="form-control @error('password_confirmation') is-invalid @enderror"
                placeholder="{{ __('adminlte::adminlte.retype_password') }}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
            </div>
          </div>
          @error('password_confirmation')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div> -->

        <div class="input-group mb-3">
            <label for="name">Campus Name</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="input-group mb-3">
            <label for="name">Country</label>
            <input type="text" id="country" name="country" required>
        </div>
        <div class="input-group mb-3">
            <label for="name">State</label>
            <input type="text" id="state" name="state" required>
        </div>
        <div class="input-group mb-3">
            <label for="name">City</label>
            <input type="text" id="City" name="city" required>
        </div>
        <div class="input-group mb-3">
            <label for="name">Street</label>
            <input type="text" id="Street" name="streetAddress" required>
        </div>
        <div class="input-group mb-3">
            <label for="name">Zip Code</label>
            <input type="text" id="Zip" name="postalCode" required>
        </div>
                        
      <x-slot name="footerSlot">
        <x-adminlte-button type="submit" class="block mr-auto" theme="success" label="Add Campus" form="newCampus"/>
        <x-adminlte-button type="button" class="block ml-auto" theme="danger" label="Cancel" data-dismiss="modal"/>
      </x-slot>  
    </form>
  </div>
</x-adminlte-modal>

@section('plugins.Datatables', true)
<div class="flex-container">
  @include('campus.partials.campustable')
</div>
@stop

<script>
    $(document).ready(function() {
        $('.btn-delete').click(function(e) {
            e.preventDefault();
            const userId = $(this).data('campus-id');
            if (confirm('Are you sure you want to delete this campus?')) {
                $.ajax({
                    url: '/campuses/' + campusId,
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        _method: 'DELETE'
                    },
                    success: function(response) {
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }
        });
    });
</script>


