<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __ ("Edit Building")}}
        </h2>
    
    <section>
        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form>

        <form method="post" action="{{  route('building.update', ['building' => $building['id']]) }}" class="mt-6 space-y-6">
            @csrf
            @method('patch')

            <div>
                <x-input-label for="name" :value="__('Building Name')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $building['name'])" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <x-input-label for="country" :value="__('Country')" />
                <x-text-input id="country" name="country" type="text" class="mt-1 block w-full" :value="old('country',  optional($building->address)->country)" />
                <x-input-error class="mt-2" :messages="$errors->get('country')" />
            </div>

            <div>
                <x-input-label for="state" :value="__('State')" />
                <x-text-input id="state" name="state" type="text" class="mt-1 block w-full" :value="old('state', $building['state'])" required autofocus autocomplete="state" />
                <x-input-error class="mt-2" :messages="$errors->get('state')" />
            </div>

            <div>
                <x-input-label for="city" :value="__('City')" />
                <x-text-input id="city" name="state" type="text" class="mt-1 block w-full" :value="old('city', $building['city'])" required autofocus autocomplete="city" />
                <x-input-error class="mt-2" :messages="$errors->get('city')" />
            </div>

            <div>
                <x-input-label for="streetAddress" :value="__('Street')" />
                <x-text-input id="streetAddress" name="state" type="text" class="mt-1 block w-full" :value="old('streetAddress', $building['streetAddress'])" required autofocus autocomplete="streetAddress" />
                <x-input-error class="mt-2" :messages="$errors->get('streetAddress')" />
            </div>

            <div>
                <x-input-label for="postalCode" :value="__('Zip')" />
                <x-text-input id="postalCode" name="state" type="text" class="mt-1 block w-full" :value="old('postalCode', $building['postalCode'])" required autofocus autocomplete="postalCode" />
                <x-input-error class="mt-2" :messages="$errors->get('postalCode')" />
            </div>

            <div class="flex items-center gap-4">
                <x-primary-button>{{ __('Save') }}</x-primary-button>

                @if (session('status') === 'building-updated')
                    <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-gray-600 dark:text-gray-400"
                    >{{ __('Saved.') }}</p>
                @endif
            </div>
        </form>
    </section>
    </x-slot>
</x-app-layout>
