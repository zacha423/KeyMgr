@extends('adminlte::page')

{{-- Resources for bootstrap-datepicker --}}
@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endpush
@push('js')  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.en-GB.min.js"></script>
@endpush

@section('title', __('Edit Lock'))

@section('content_header')
    <h1>{{ __('Edit Lock') }}</h1>
@stop

@section('plugins.BootStrapSelect', true)

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="post" action="{{ route('locks.update', ['lock' => $lock['id']]) }}" class="space-y-6">
                @csrf
                @method('patch')

                {{-- Number of pins --}}
                <div class="form-group">
                    <label for="numPins" class="col-form-label">{{ __('Number of Pins') }}</label>
                    <input id="numPins" name="numPins" type="text" class="form-control" value="{{ old('numPins', $lock['numPins']) }}">
                    @error('numPins')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Building --}}
                <x-adminlte-select-bs name="building" label="Building" data-live-search data-live-search-placeholder="Search..." data-show-tick>
                  <x-adminlte-options :options="$buildings" :selected="$lock['building_id']"></x-adminlte-options>
                </x-adminlte-select-bs>

                {{-- Room --}}
                <x-adminlte-select-bs name="room" label="Room" data-live-search data-live-search-placeholder="Search..." data-show-tick>
                  <x-adminlte-options :options="$rooms" :selected="$lock['room_id']"></x-adminlte-options>
                </x-adminlte-select-bs>

                <div class="form-group">
                    <label for="upperPinLengths" class="col-form-label">{{ __('Upper Pin Lengths') }}</label>
                    <input id="upperPinLengths" name="upperPinLengths" type="text" class="form-control" value="{{ old('upperPinLengths', $lock['upperPinLengths']) }}">
                    @error('upperPinLengths')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="lowerPinLengths" class="col-form-label">{{ __('Lower Pin Lengths') }}</label>
                    <input id="lowerPinLengths" name="lowerPinLengths" type="text" class="form-control" value="{{ old('lowerPinLengths', $lock['lowerPinLengths']) }}">
                    @error('lowerPinLengths')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="installDate" class="col-form-label">{{ __('Install Date') }}</label>
                    <input id="installDate" name="installDate" type="text" class="form-control datepicker" value="{{ old('installDate', $lock['installDate']) }}">
                    @error('installDate')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="keyway_id">Keyway</label>
                    <select class="form-control" id="keyway_id" name="keyway_id">
                        @foreach($keyways as $keyway)
                            @if($keyway['id'] != $lock['keyway'])
                                <option value="{{ $keyway['id'] }}">
                                    {{ $keyway['name'] }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                    @error('keyway_id')
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

<script>
$(document).ready(function() {
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        todayHighlight: true
    });
    $('.datepicker').datepicker('update', $('.datepicker').val());

    $('#building').change(() => {
      const id = $('#building').val();

      $.ajax({
        type: "GET",
        url: "{{ route('getRooms') }}",
        data: {
          building_id: id
        },
        success: function(res) {
          if(res) {
            $('#room').html(res);
            $('#room').selectpicker('refresh');
          }
        }
      });
    });
});
</script>



@stop
