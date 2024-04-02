@extends('adminlte::page')

@section('title', __('Edit Key'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('Edit Key') }}</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form method="post" action="{{ route('keys.update', ['key' => $key['id']]) }}" class="space-y-6">
            @csrf
            @method('patch')

            <!-- Key Level Field -->
            <div class="form-group">
                <label for="keyLevel" class="col-form-label">{{ __('Key Level') }}</label>
                <input id="keyLevel" name="keyLevel" type="text" class="form-control" value="{{ old('keyLevel', $key['keyLevel']) }}">
                @error('keyLevel')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <!-- Key System Field -->
            <div class="form-group">
                <label for="keySystem" class="col-form-label">{{ __('Key System') }}</label>
                <input id="keySystem" name="keySystem" type="text" class="form-control" value="{{ old('keySystem', $key['keySystem']) }}">
                @error('keySystem')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <!-- Copy Number Field -->
            <div class="form-group">
                <label for="copyNumber" class="col-form-label">{{ __('Copy Number') }}</label>
                <input id="copyNumber" name="copyNumber" type="number" class="form-control" value="{{ old('copyNumber', $key['copyNumber']) }}">
                @error('copyNumber')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <!-- Key Bitting Field -->
            <div class="form-group">
                <label for="bitting" class="col-form-label">{{ __('Key Bitting') }}</label>
                <input id="bitting" name="bitting" type="text" class="form-control" value="{{ old('bitting', $key['bitting']) }}">
                @error('bitting')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <!-- Key Replacement Cost Field -->
            <div class="form-group">
                <label for="replacementCost" class="col-form-label">{{ __('Key Replacement Cost') }}</label>
                <input id="replacementCost" name="replacementCost" type="number" class="form-control" value="{{ old('replacementCost', $key['replacementCost']) }}">
                @error('replacementCost')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <!-- Key Status Field -->
            <div class="form-group">
                <label for="key_status_id">Key Status</label>
                <select class="form-control" id="key_status_id" name="key_status_id">
                    @foreach($keyStatuses as $keyStatus)
                        @if($keyStatus['id'] != $key['status'])
                            <option value="{{ $keyStatus['id'] }}">
                                {{ $keyStatus['name'] }}
                            </option>
                        @endif
                    @endforeach
                </select>
                @error('key_status_id')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <!-- Keyway Field -->
            <div class="form-group">
                <label for="keyway_id">Keyway</label>
                <select class="form-control" id="keyway_id" name="keyway_id">
                    @foreach($keyways as $keyway)
                        @if($keyway['id'] != $key['keyway'])
                            <option value="{{ $keyway['id'] }}">
                                {{ $keyway['name'] }}
                            </option>
                        @endif
                    @endforeach
                </select>
                @error('keyway_id')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                @if (session('status') === 'key-updated')
                    <p class="ml-4 text-success">{{ __('Saved.') }}</p>
                @endif
            </div>
        </form>
    </div>
</div>

@stop
