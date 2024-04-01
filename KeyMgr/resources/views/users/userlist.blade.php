@extends ("adminlte::page")

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@section ("content")
@section('plugins.Datatables', true)
@section('plugins.BootStrapSelect', true)
@section('plugins.BootStrapSwitch', true)
<x-adminlte-card theme="info" theme-mode="outline" title="Limit results by:">
  <form action="/users" method="GET">
    <!-- Drop Down for UserRoles and UserGroups -->
    <div class="flex-container">
      @php
        $config3 = [
            'onColor' => 'green',
            'offColor' => 'red',
            'onText' => 'Add',
            'offText' => 'Remove',
            'animate' => true,
            'state' => true,
        ];
      @endphp
      <div class="row"><x-adminlte-input-switch name="iswSizeLG" label="Operation" :config="$config3">    <x-slot name="prependSlot">
        <div class="input-group-text bg-lightblue">
            <i class="fas fa-toggle-on"></i>
        </div>
    </x-slot></x-adminlte-input-switch></div>
      <div class="row">
        
        <div class="col-6" id="groupSelector">
          <x-group-selector id="gSelector" :options="$groupOptions" :selected="$selectedGroups"></x-group-selector>
        </div>
        <div class="col-6" id="roleSelector">
          <x-role-selector id="rSelector" :options="$roleOptions" :selected="$selectedRoles"></x-role-selector>
        </div>
      </div>
      
      <div class="row">
        {{-- Button to refresh page / limit search --}}
        <div class="col">
          <button type="submit" class="btn btn-primary refineSearch" id="refineSearch">
            Refine Search
          </button>
        </div>
      </div>
    </div>
  </form>
</x-adminlte-card>
{{-- User Management Tools --}}
<x-adminlte-card theme="info" theme-mode="outline" title="Tools">
  <x-adminlte-button type="button" theme="primary" id="addRole" name="addRole" label="Manage Roles"></x-adminlte-button>
  <x-adminlte-button type="button" theme="primary" id="addGroup" name="addGroup" label="Manage Groups"></x-adminlte-button>
  <x-adminlte-button type="button" theme="success" data-toggle="modal" data-target="#userForm" label="Register New User"></x-adminlte-button>

  <!-- New USer Modal -->
  <x-adminlte-modal id="userForm" title="User Creation Form" theme="lightblue" size="sm1" icon="fas fa-user" 
                    v-centered static-backdrop scrollable>
    <div>
      <form id="newUser" action="/users" method="POST">
        @csrf

        {{-- First Name field --}}
        <div class="input-group mb-3">
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
          </div>
      
          {{-- If the button is in the footer, it's not part of the form for some reason." --}}
        <x-slot name="footerSlot">
          <x-adminlte-button type="submit" class="block mr-auto" theme="success" label="Add User" form="newUser"/>
          <x-adminlte-button type="button" class="block ml-auto" theme="danger" label="Cancel" data-dismiss="modal"/>
        </x-slot>  
      </form>
    </div>
  </x-adminlte-modal>
</x-adminlte-card>

{{-- The actual datatable --}}

<div class="flex-container">
  @include('users.partials.usertable')
</div>
@stop

<script>
    $(document).ready(function() {
        $('.btn-delete').click(function(e) {
            e.preventDefault();
            const userId = $(this).data('user-id');
            if (confirm('Are you sure you want to delete this user?')) {
                $.ajax({
                    url: '/users/' + userId,
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
