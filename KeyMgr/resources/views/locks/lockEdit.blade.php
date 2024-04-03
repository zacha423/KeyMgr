@extends('adminlte::page')

@section('title', __('Edit Lock'))

@section('content_header')
    <h1>{{ __('Edit Lock') }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="post" action="{{ route('locks.update', ['lock' => $lock['id']]) }}" class="space-y-6">
                @csrf
                @method('patch')

                <div class="form-group">
                    <label for="number" class="col-form-label">{{ __('lock Number') }}</label>
                    <input id="number" name="number" type="text" class="form-control" value="{{ old('number', $lock['number']) }}" required autofocus autocomplete="number">
                    @error('number')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description" class="col-form-label">{{ __('Description') }}</label>
                    <input id="description" name="lockDesc" type="text" class="form-control" value="{{ old('description', $lock['description']) }}">
                    @error('description')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="buildingID" class="col-form-label">{{ __('Select Building') }}</label>
                    <select id="buildingID" name="building" class="form-control">
                        <option value="{{ $lock['buildingID'] }}" disabled selected>{{ $lock['building']->name }}</option>
                        @foreach($buildings as $building)
                            @if($building['id'] != $lock['building_id'])
                                <option value="{{ $building['id'] }}">{{ $building['name'] }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="doorDesc" class="col-form-label">{{ __('Door Description') }}</label>
                    <input id="doorDesc" name="doorDesc" type="text" class="form-control" value="{{ old('doorDesc', $lock->doors->first()->description) }}">
                    @error('doorDesc')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="doorHWDesc" class="col-form-label">{{ __('Door Hardware Description') }}</label>
                    <input id="doorHWDesc" name="doorHWDesc" type="text" class="form-control" value="{{ old('doorHWDesc', $lock->doors->first()->hardwareDescription) }}">
                    @error('doorHWDesc')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                    @if (session('status') === 'lock-updated')
                        <p class="ml-4 text-success">{{ __('Saved.') }}</p>
                    @endif
                </div>
            </form>
        </div>
    </div>
@stop
