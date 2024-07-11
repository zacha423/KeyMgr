@extends ("adminlte::page")
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@section('title', __('Campuses'))

@section ("content")
@section('content_header')
    <h1>List of Campuses</h1>
    <div class="col text-right">
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#campusForm">
        New Campus
      </button>
      </div>  
@stop
@section('plugins.Datatables', true)

@include('campus.partials.newCampusModal')

<div class="flex-container">
  @include('campus.partials.campus-table')
</div>
@stop

@push('js')
<script>
    $(document).ready(function() {
        $('.btn-delete').click(function(e) {
            e.preventDefault();
            const campusId = $(this).data('campus-id');
            if (confirm('Are you sure you want to delete this campus?')) {
                $.ajax({
                    url: '/campus/' + campusId,
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        _method: 'DELETE'
                    },
                    success: function(response) {
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }
        });
    });
</script>
@endpush