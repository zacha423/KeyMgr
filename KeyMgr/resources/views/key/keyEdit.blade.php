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

                <div class="form-group">
                    <label for="keyLevel" class="col-form-label">{{ __('Key Level') }}</label>
                    <input id="keyLevel" name="keyLevel" type="text" class="form-control" value="{{ old('keyLevel', $key['keyLevel']) }}" required autofocus>
                    @error('keyLevel')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="keySystem" class="col-form-label">{{ __('Key System') }}</label>
                    <input id="keySystem" name="keySystem" type="text" class="form-control" value="{{ old('keySystem', $key['keySystem']) }}" required>
                    @error('keySystem')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="copyNumber" class="col-form-label">{{ __('Copy Number') }}</label>
                    <input id="copyNumber" name="copyNumber" type="number" class="form-control" value="{{ old('copyNumber', $key['copyNumber']) }}" required>
                    @error('copyNumber')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="bitting" class="col-form-label">{{ __('Key Bitting') }}</label>
                    <input id="bitting" name="bitting" type="text" class="form-control" value="{{ old('bitting', $key['bitting']) }}">
                    @error('bitting')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="replacementCost" class="col-form-label">{{ __('Key Replacement Cost') }}</label>
                    <input id="replacementCost" name="replacementCost" type="number" class="form-control" value="{{ old('replacementCost', $key['replacementCost']) }}" required>
                    @error('replacementCost')
                        <div class="text-danger">{{ $message }}</div>
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
