@extends('adminlte::page')
<script src="https://code.jquery.com/jquery-3.6.0.mins.js"></script>
@section('title', __('Profile'))

@section('content_header')
    <h1>Profile</h1>
@stop 
@section("content")
@php
$theme = 'lightblue';
if($user->isElevated()){
    $theme = "danger";
}
@endphp
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <x-adminlte-profile-widget :theme="$theme" :name="$user->getFullname()">
                <x-adminlte-profile-row-item title="KeyMgr @ Pacific University" class="text-center border-bottom border-secondary"/>
            </x-adminlte-profile-widget>
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
                    <x-list-group :elements="$groups"/>
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
                <x-adminlte-card theme="info" theme-mode="outline" title="Role Memberships" collapsible>
                    <x-list-group :elements="$roles"/>
                </x-adminlte-card>
            @endif
        </div>
     </div> 
</div>
@stop