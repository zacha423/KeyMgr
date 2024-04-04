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

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="post" action="{{ route('locks.update', ['lock' => $lock['id']]) }}" class="space-y-6">
                @csrf
                @method('patch')

                {{-- Number of pins --}}
                <div class="form-group">
                    <label for="numPins" class="col-form-label">{{ __('Number of Pins') }}</label>
                    <input id="numPins" name="numPins" type="text" class="form-control" value="{{ old('numPins', $lock['numPins']) }}" required autofocus autocomplete="number">
                    @error('numPins')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Building --}}
                <div class="form-group">
                    <label for="building" class="col-form-label">{{ __('Select Building') }}</label>
                    <select id="building" name="building" class="form-control">
                        <option value="{{ $lock['building'] }}">{{ $lock['building'] }}</option>
                        @foreach($buildings as $building)
                             <option value="{{ $building['id'] }}">{{ $building['name'] }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group" id="roomSelection">
                    <label id="roomLbl" for="room" class="col-form-label">{{ __('Select Room') }}</label>
                    <select id="room" name="room" class="form-control">
                        <!-- Options will be dynamically populated based on selected building -->
                    </select>
                    @error('room')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
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

    $('#building').change(function() {
        var buildingID = $(this).val();
        if (buildingID) {
            $.ajax({
                type: "GET",
                url: "{{ route('getRooms') }} $building_id=" + buildingID,
                success: function(res) {
                    if (res) {
                        console.log("success");
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

    // Set lock's room initially if available
    var lockRoomNumber = "{{ $lock['room'] }}";
    if (lockRoomNumber && lockRoomNumber.trim() !== "") {
        $("#room").append('<option value="' + lockRoomNumber + '" selected>' + lockRoomNumber + '</option>');
        $("#roomSelection").show();
    }

    // Trigger change event for initial value
    $('#building').change();
});
</script>



@stop
