<form id="updatePassword" action="{{ route('password.update') }}" method="POST">
<x-adminlte-modal id="passwordModal" title="Update Password" theme="$lightblue" v-centered scrollable>
  
    @csrf
    @method('put')

    <div class="row">
      <div class="col">
        <x-adminlte-input label="Current Password" name="current_password" type="password" autocomplete="current-password"/>
        <x-adminlte-input label="New Password" name="password" type="password" autocomplete="new-password" />
        <x-adminlte-input label="Confirm Password" name="password_confirmation" type="password" autocomplete="new-password"/>
      </div>
    </div>
  
  <x-slot name="footerSlot"><x-adminlte-button label="Change Password" theme="success" type="submit" class="mr-auto"/><x-adminlte-button label="Cancel" theme="danger" data-dismiss="modal"/></x-slot>
</x-adminlte-modal>
</form>

{{-- Good candidate to replace with SweetAlert2 or similar. --}}
@if (session('status') === 'password-updated')
  <x-adminlte-alert theme="success" dismissable title="Password Changed">Successful</x-adminlte-alert>
@endif