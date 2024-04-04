<section>
    <form method="POST" action="{{ route('campus.update', ['campus' => $campus['id']]) }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')
        <div class="row">
            <div class="col-md-3">
                <x-adminlte-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $campus['name'])" label="{{ __('Campus Name') }}" required autofocus autocomplete="name" enable-old-support></x-adminlte-input>

                <x-adminlte-input id="country" name="country" type="text" class="mt-1 block w-full" :value="old('country', $campus['country'])" label="{{ __('Country') }}" required autocomplete="country" enable-old-support></x-adminlte-input>

                <x-adminlte-input id="state" name="state" type="text" class="mt-1 block w-full" :value="old('state', $campus['state'])" label="{{ __('State') }}" required autocomplete="state" enable-old-support></x-adminlte-input>

                <x-adminlte-input id="city" name="city" type="text" class="mt-1 block w-full" :value="old('city', $campus['city'])" label="{{ __('City') }}" required autocomplete="city" enable-old-support></x-adminlte-input>

                <x-adminlte-input id="streetAddress" name="streetAddress" type="text" class="mt-1 block w-full" :value="old('streetAddress', $campus['streetAddress'])" label="{{ __('Street Address') }}" required autocomplete="streetAddress" enable-old-support></x-adminlte-input>

                <x-adminlte-input id="postalCode" name="postalCode" type="text" class="mt-1 block w-full" :value="old('postalCode', $campus['postalCode'])" label="{{ __('Zip') }}" required autocomplete="postalCode" enable-old-support></x-adminlte-input>
            </div>
        </div>

        <div class="row">
            <div class="flex items-center gap-4">
                <x-adminlte-button type="submit" theme="primary" label="{{ __('Save') }}"></x-adminlte-button>

                @if(session('status') === 'profile-updated')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)" class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
                @endif
            </div>
        </div>
    </form>
</section>
