<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('User Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update or view the selected users information.") }}
        </p>
    </header>

    <form method="post" action="{{ route('users.update', ['user' => $user]) }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')
        <div class="row">
          <div class="col-md-3">
            <x-adminlte-input name="firstName" :value="old('firstName', $user->firstName)" label="{{__('First Name')}}" 
              enable-old-support required autocomplete autofocus>
            </x-adminlte-input>
            <x-adminlte-input name="username" :value="old('username', $user->username)" label="{{__('Username')}}" 
              enable-old-support required autocomplete autofocus>
            </x-adminlte-input>
          </div>
          <div class="col-md-3">
            <x-adminlte-input name="lastName" :value="old('lastName', $user->lastName)" label="{{__('Last Name')}}" 
              enable-old-support required autocomplete autofocus>
            </x-adminlte-input>
            <x-adminlte-input name="email" :value="old('email', $user->email)" label="{{__('Email')}}" 
              enable-old-support required autocomplete autofocus>
            </x-adminlte-input>
          </div>
        </div>

        {{-- 
          This is just a cheap/easy way to quickly display the data. Hopefully there's something better. 
          Maybe each group/role as a clickable link?
        --}}
        <div class="row">
          <div class="col-md-3">
            <x-adminlte-select label="Group Memberships" id="usergroups" name="usergroups[]" multiple>
              <x-adminlte-options :options="$memberGroups"></x-adminlte-options>
            </x-adminlte-select>
          </div>
          <div class="col-md-3">
            <x-adminlte-select label="Role Memberships" id="userroles" name="userroles[]" multiple>
              <x-adminlte-options :options="$memberRoles"></x-adminlte-options>
            </x-adminlte-select> 
          </div>
        </div>

        

        <div class="row">
          <div class="flex items-center gap-4">
              <x-adminlte-button type="submit" theme="primary" label="{{__('Save')}}"></x-adminlte-button>

              @if (session('status') === 'profile-updated')
                  <p
                      x-data="{ show: true }"
                      x-show="show"
                      x-transition
                      x-init="setTimeout(() => show = false, 2000)"
                      class="text-sm text-gray-600 dark:text-gray-400"
                  >{{ __('Saved.') }}</p>
              @endif
          </div>
        </div>
    </form>
</section>

