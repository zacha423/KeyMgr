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
                    <label for="numPins" class="col-form-label">{{ __('Number of Pins') }}</label>
                    <input id="numPins" name="numPins" type="text" class="form-control" value="{{ old('numPins', $lock['numPins']) }}" required autofocus autocomplete="number">
                    @error('numPins')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="building" class="col-form-label">{{ __('Select Building') }}</label>
                    <select id="building" name="building" class="form-control">
                        <option value="" disabled selected>Select Building</option>
                        @foreach($buildings as $building)
                            <option value="{{ $building['id'] }}">{{ $building['name'] }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group" id="roomSelection" style="display: none;">
                    <label for="room" class="col-form-label">{{ __('Select Room') }}</label>
                    <select id="room" name="room" class="form-control">
                        <!-- Options will be dynamically populated based on selected building -->
                    </select>
                </div>

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
                    <input id="installDate" name="installDate" type="text" class="form-control" value="{{ old('installDate', $lock['installDate']) }}">
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
                        <p class="text-danger">{{ $message }}</p>
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

    <!-- CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.en-GB.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#installDate').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true
            });

            $('#building').change(function() {
                var buildingID = $(this).val();
                if (buildingID) {
                    $.ajax({
                        type: "GET",
                        url: "{{ route('getRooms') }}?building_id=" + buildingID,
                        success: function(res) {
                            if (res) {
                                $("#roomSelection").show();
                                $("#room").empty();
                                $.each(res, function(key, value) {
                                    $("#room").append('<option value="' + key + '">' + value + '</option>');
                                });
                            } else {
                                $("#roomSelection").hide();
                            }
                        }
                    });
                } else {
                    $("#roomSelection").hide();
                }
            });
        });
    </script>

@stop
