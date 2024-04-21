@extends('adminlte::page')
<script src="https://code.jquery.com/jquery-3.6.0.mins.js"></script>
@section('title', __('Profile'))

@section('content_header')
    <h1>Profile</h1>
@stop 
@section("content")
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <x-adminlte-profile-widget :name="$user->getFullname()"><x-adminlte-profile-col-item title="Held Keys" text=""/><x-adminlte-profile-col-item title="Outstanding Keys" text=""/><x-adminlte-profile-col-item title="Active Authorizations" text=""/></x-adminlte-profile-widget>
        </div>
    </div>
     <div class="row">
        <div class="col-sm-6">
            <x-adminlte-card theme="info" theme-mode="outline" title="Account Information">
                <x-adminlte-input label="Account ID" name="accountID" :value="$user->id" disabled/>
                <x-adminlte-input label="Username" name="username" :value="$user->username" disabled/>
                <x-adminlte-button label="Update Password" data-toggle="modal"/>
            </x-adminlte-card >
            @if(!empty($groups))
            <x-adminlte-card theme="info" theme-mode="outline" title="Group Memberships" collapsible>
                <x-list-group :elements="$groups"></x-list-group>
            </x-adminlte-card>
            @endif
        </div>
        <div class="col-sm-6">
            <x-adminlte-card theme="info" theme-mode="outline" title="Contact Information">
                <x-adminlte-input label="First Name" name="firstName" :value="$user->firstName" disabled/>
                <x-adminlte-input label="Last Name" name="lastName" :value="$user->lastName" disabled/>
                <x-adminlte-input label="Email" name="email" :value="$user->email" disabled/>
            </x-adminlte-card>

            @if(!empty($roles))
            <x-adminlte-card theme="info" theme-mode="outline" title="Role Memberships" collapsible><x-list-group :elements="$roles"></x-list-group></x-adminlte-card>
            @endif
        </div>
     </div> 
</div>
{{--<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>--}}
@stop