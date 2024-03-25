<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __ ("Edit Room")}}
        </h2>
    
    <section>
        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form>

        <form method="post" action="{{  route('room.update', ['room' => $room['id']]) }}" class="mt-6 space-y-6">
            @csrf
            @method('patch')

            <div>
                <x-input-label for="number" :value="__('Room Number')" />
                <x-text-input id="number" name="number" type="text" class="mt-1 block w-full" :value="old('number', $room['number'])" required autofocus autocomplete="number" />
                <x-input-error class="mt-2" :messages="$errors->get('number')" />
            </div>

            <div>
                <x-input-label for="description" :value="__('Description')" />
                <x-text-input id="description" name="roomDesc" type="text" class="mt-1 block w-full" :value="old('description', $room['description'])" />
                <x-input-error class="mt-2" :messages="$errors->get('description')" />
            </div>

            <div>
                <label for="buildingID" class="block text-sm font-medium text-gray-700">Select Building</label>
                <select id="buildingID" name="building" class="mt-1 p-2 border rounded-md w-full">
                    <option value="{{ $room['buildingID'] }}" disabled selected>{{ $room['building']->name }}</option>
                    @foreach($buildings as $building)
                        @if($building['id'] != $room['building_id'])
                            <option value="{{ $building['id'] }}">
                                {{ $building['name'] }}
                            </option>
                        @endif
                    @endforeach
                </select>

            </div>

            <div>
                <x-input-label for="doorDesc" :value="__('Door Description')" />
                <x-text-input id="doorDesc" name="doorDesc" type="text" class="mt-1 block w-full" 
                              :value="old('doorDesc', $room->doors->first()->description)" />
                <x-input-error class="mt-2" :messages="$errors->get('doorDesc')" />
            </div>

            <div>
                <x-input-label for="doorHWDesc" :value="__('Door Hardware Description')" />
                <x-text-input id="doorHWDesc" name="doorHWDesc" type="text" class="mt-1 block w-full" 
                              :value="old('doorHWDesc', $room->doors->first()->hardwareDescription)" />
                <x-input-error class="mt-2" :messages="$errors->get('doorHWDesc')" />
            </div>

            <div class="flex items-center gap-4">
                <x-primary-button>{{ __('Save') }}</x-primary-button>

                @if (session('status') === 'room-updated')
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