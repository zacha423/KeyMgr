@extends('adminlte::page')

@section('title', __('Edit Building'))

@section('content_header')
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Edit Building') }}
    </h2>
@stop

@section('content')
    <form method="post" action="{{ route('building.update', ['building' => $building['id']]) }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="row">
            <div class="col-md-6">
                <x-input-label for="name" :value="__('Building Name')" />
                <x-text-input id="name" name="name" type="text" class="form-control" :value="old('name', $building['name'])" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div class="col-md-6">
                <x-input-label for="country" :value="__('Country')" />
                <x-text-input id="country" name="country" type="text" class="form-control" :value="old('country', $building['country'])" />
                <x-input-error class="mt-2" :messages="$errors->get('country')" />
            </div>

            <div class="col-md-6">
                <x-input-label for="state" :value="__('State')" />
                <x-text-input id="state" name="state" type="text" class="form-control" :value="old('state', $building['state'])" required autofocus autocomplete="state" />
                <x-input-error class="mt-2" :messages="$errors->get('state')" />
            </div>

            <div class="col-md-6">
                <x-input-label for="city" :value="__('City')" />
                <x-text-input id="city" name="city" type="text" class="form-control" :value="old('city', $building['city'])" required autofocus autocomplete="city" />
                <x-input-error class="mt-2" :messages="$errors->get('city')" />
            </div>

            <div class="col-md-6">
                <x-input-label for="streetAddress" :value="__('Street')" />
                <x-text-input id="streetAddress" name="streetAddress" type="text" class="form-control" :value="old('streetAddress', $building['streetAddress'])" required autofocus autocomplete="streetAddress" />
                <x-input-error class="mt-2" :messages="$errors->get('streetAddress')" />
            </div>

            <div class="col-md-6">
                <x-input-label for="postalCode" :value="__('Zip')" />
                <x-text-input id="postalCode" name="postalCode" type="text" class="form-control" :value="old('postalCode', $building['postalCode'])" required autofocus autocomplete="postalCode" />
                <x-input-error class="mt-2" :messages="$errors->get('postalCode')" />
            </div>

            <div class="col-md-6">
                <label for="campus" class="block text-sm font-medium text-gray-700">Select Campus</label>
                <select id="campus" name="campus" class="form-control">
                    <option value="{{$building['id']}}" disabled selected>{{$building['campus']}}</option>
                    @foreach($campuses as $campus)
                        <option value="{{ $campus['id'] }}">{{ $campus['name'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-6">
                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
            </div>

            <div class="col-md-6">
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
        </div>
    </form>
@stop
