<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    @vite(['resources/css/moretest.css'])
</head>
<title>Edit Campus</title>
<body>
    <div class="container">
        <h1>Edit Campus</h1>
        <form method="POST" action="{{ route('campus.update', ['campus' =>$campus['id']]) }}">
            @csrf
            @method('PATCH')
            
            <div class="form-group">
                <label for="name">Campus Name</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ $campus['name'] }}">
            </div>
            <div class="form-group">
                <label for="country">Country</label>
                <input type="text" id="country" name="country" class="form-control" value="{{ $campus['country'] }}">
            </div>
            <div class="form-group">
                <label for="state">State</label>
                <input type="text" id="state" name="state" class="form-control" value="{{ $campus['state'] }}">
            </div>
            <div class="form-group">
                <label for="city">City</label>
                <input type="text" id="city" name="city" class="form-control" value="{{ $campus['city'] }}">
            </div>
            <div class="form-group">
                <label for="streetAddress">Street Address</label>
                <input type="text" id="streetAddress" name="streetAddress" class="form-control" value="{{ $campus['streetAddress'] }}">
            </div>
            <div class="form-group">
                <label for="postalCode">Postal Code</label>
                <input type="text" id="postalCode" name="postalCode" class="form-control" value="{{ $campus['postalCode'] }}">
            </div>
            <div class="form-group">
                <input type="submit" class="button" value="Update">
            </div>
        </form>
    </div>
</body>
</html> -->


<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __ ("Edit Campus")}}
        </h2>
    
    <section>
        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form>

        <form method="POST" action="{{ route('campus.update', ['campus' =>$campus['id']]) }}" class="mt-6 space-y-6">
            @csrf
            @method('PATCH')

            <div>
                <x-input-label for="name" :value="__('Campus Name')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $campus['name'])" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <x-input-label for="country" :value="__('Country')" />
                <x-text-input id="country" name="country" type="text" class="mt-1 block w-full" :value="old('country',  $campus['country'])" />
                <x-input-error class="mt-2" :messages="$errors->get('country')" />
            </div>

            <div>
                <x-input-label for="state" :value="__('State')" />
                <x-text-input id="state" name="state" type="text" class="mt-1 block w-full" :value="old('state', $campus['state'])" required autofocus autocomplete="state" />
                <x-input-error class="mt-2" :messages="$errors->get('state')" />
            </div>

            <div>
                <x-input-label for="city" :value="__('City')" />
                <x-text-input id="city" name="city" type="text" class="mt-1 block w-full" :value="old('city', $campus['city'])" required autofocus autocomplete="city" />
                <x-input-error class="mt-2" :messages="$errors->get('city')" />
            </div>

            <div>
                <x-input-label for="streetAddress" :value="__('Street')" />
                <x-text-input id="streetAddress" name="streetAddress" type="text" class="mt-1 block w-full" :value="old('streetAddress', $campus['streetAddress'])" required autofocus autocomplete="streetAddress" />
                <x-input-error class="mt-2" :messages="$errors->get('streetAddress')" />
            </div>

            <div>
                <x-input-label for="postalCode" :value="__('Zip')" />
                <x-text-input id="postalCode" name="postalCode" type="text" class="mt-1 block w-full" :value="old('postalCode', $campus['postalCode'])" required autofocus autocomplete="postalCode" />
                <x-input-error class="mt-2" :messages="$errors->get('postalCode')" />
            </div>

            <div class="flex items-center gap-4">
                <x-primary-button>{{ __('Save') }}</x-primary-button>

                
            </div>
        </form>
    </section>
    </x-slot>
</x-app-layout>