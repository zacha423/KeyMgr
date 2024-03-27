@extends("adminlte::page")

@section("content")

<form method="POST" action="{{ route('campus.update', ['campus' =>$campus['id']]) }}" class="mt-6 space-y-6">
            @csrf
            @method('PATCH')

            <!-- <div class="form-group">
            <label for="name" :value="__('Campus Name')" >Campus Name</label>
            <input id="name" name="name" type="text" class="form-control" :value="old('name', $campus['name'])" required autofocus autocomplete="name" />
            <error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div class="form-group">
            <label for="country" :value="__('Country')" >Country</label>
            <input id="country" name="country" type="text" class="form-control" :value="old('country',  $campus['country'])" />
            <error class="mt-2" :messages="$errors->get('country')" />
            </div>

            <div class="form-group">
            <label for="state" :value="__('State')" >State</label>
            <input id="state" name="state" type="text" class="form-control" :value="old('state', $campus['state'])" required autofocus autocomplete="state" />
            <error class="mt-2" :messages="$errors->get('state')" />
            </div>

            <div class="form-group">
            <label for="city" :value="__('City')" >City</label>
            <input id="city" name="city" type="text" class="form-control" :value="old('city', $campus['city'])" required autofocus autocomplete="city" />
            <error class="mt-2" :messages="$errors->get('city')" />
            </div>

            <div class="form-group">
            <label for="streetAddress" :value="__('Street')" >Street</label>
            <input id="streetAddress" name="streetAddress" type="text" class="form-control" :value="old('streetAddress', $campus['streetAddress'])" required autofocus autocomplete="streetAddress" />
            <error class="mt-2" :messages="$errors->get('streetAddress')" />
            </div>

            <div class="form-group">
            <label for="postalCode" :value="__('Zip')" >Zip</label>
            <input id="postalCode" name="postalCode" type="text" class="form-control" :value="old('postalCode', $campus['postalCode'])" required autofocus autocomplete="postalCode" />
            <error class="mt-2" :messages="$errors->get('postalCode')" />
            </div> -->

            <div class="form-group">
                <x-input-label for="name" :value="__('Campus Name')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $campus['name'])" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div class="form-group">
                <x-input-label for="country" :value="__('Country')" />
                <x-text-input id="country" name="country" type="text" class="mt-1 block w-full" :value="old('country',  $campus['country'])" />
                <x-input-error class="mt-2" :messages="$errors->get('country')" />
            </div>

            <div class="form-group">
                <x-input-label for="state" :value="__('State')" />
                <x-text-input id="state" name="state" type="text" class="mt-1 block w-full" :value="old('state', $campus['state'])" required autofocus autocomplete="state" />
                <x-input-error class="mt-2" :messages="$errors->get('state')" />
            </div>

            <div class="form-group">
                <x-input-label for="city" :value="__('City')" />
                <x-text-input id="city" name="city" type="text" class="mt-1 block w-full" :value="old('city', $campus['city'])" required autofocus autocomplete="city" />
                <x-input-error class="mt-2" :messages="$errors->get('city')" />
            </div>

            <div class="form-group">
                <x-input-label for="streetAddress" :value="__('Street')" />
                <x-text-input id="streetAddress" name="streetAddress" type="text" class="mt-1 block w-full" :value="old('streetAddress', $campus['streetAddress'])" required autofocus autocomplete="streetAddress" />
                <x-input-error class="mt-2" :messages="$errors->get('streetAddress')" />
            </div>

            <div class="form-group">
                <x-input-label for="postalCode" :value="__('Zip')" />
                <x-text-input id="postalCode" name="postalCode" type="text" class="mt-1 block w-full" :value="old('postalCode', $campus['postalCode'])" required autofocus autocomplete="postalCode" />
                <x-input-error class="mt-2" :messages="$errors->get('postalCode')" />
            </div>

            <div class="flex items-center gap-4">
                <x-primary-button>{{ __('Save') }}</x-primary-button>

                
            </div>
        </form>

<!-- <div class="container">
    <h1>Campus Information</h1>
    @include('campus.addressShow')
    <a href="{{ route('campus.edit', ['campus' => $campus['id']]) }}">{{ "Edit" }}</a>
</div>

<div class="card-body">
    <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
    </div>
    <div class="form-group">
        <label for="exampleInputFile">File input</label>
        <div class="input-group">
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="exampleInputFile">
                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
            </div>
            <div class="input-group-append">
                <span class="input-group-text">Upload</span>
            </div>
        </div>
    </div>
    <div class="form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Check me out</label>
    </div>
</div> -->

@stop
