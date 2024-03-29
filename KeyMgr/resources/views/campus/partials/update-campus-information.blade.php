<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Campus Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update or view the selected campus information.") }}
        </p>
    </header>

    <form method="POST" action="{{ route('campus.update', ['campus' =>$campus['id']]) }}" class="mt-6 space-y-6">        @csrf
        @method('patch')
        <div class="row">
          <div class="col-md-3">
            <x-adminlte-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $campus['name'])" required autofocus autocomplete="name" label="{{__('Campus Name')}}" 
              enable-old-support required autocomplete autofocus>
            </x-adminlte-input>
            <x-adminlte-input id="country" name="country" type="text" class="mt-1 block w-full" :value="old('country',  $campus['country'])" label="{{__('Country')}}" 
              enable-old-support required autocomplete autofocus>
            </x-adminlte-input>
            <x-adminlte-input id="state" name="state" type="text" class="mt-1 block w-full" :value="old('state', $campus['state'])" required autofocus autocomplete="state" label="{{__('State')}}" 
              enable-old-support required autocomplete autofocus>
            </x-adminlte-input>
            <x-adminlte-input id="city" name="city" type="text" class="mt-1 block w-full" :value="old('city', $campus['city'])" required autofocus autocomplete="city" label="{{__('City')}}" 
              enable-old-support required autocomplete autofocus>
            </x-adminlte-input>
            <x-adminlte-input id="streetAddress" name="streetAddress" type="text" class="mt-1 block w-full" :value="old('streetAddress', $campus['streetAddress'])" required autofocus autocomplete="streetAddress" label="{{__('Street Address')}}" 
              enable-old-support required autocomplete autofocus>
            </x-adminlte-input>
            <x-adminlte-input id="postalCode" name="postalCode" type="text" class="mt-1 block w-full" :value="old('postalCode', $campus['postalCode'])" required autofocus autocomplete="postalCode" label="{{__('Zip')}}" 
              enable-old-support required autocomplete autofocus>
            </x-adminlte-input>
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