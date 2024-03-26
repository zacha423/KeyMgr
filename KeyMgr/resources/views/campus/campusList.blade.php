
@extends ("adminlte::page")
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@section ("content")

@section('plugins.Datatables', true)
<div class="flex-container">
  @include('campus.partials.campustable')
</div>
@stop

<script>
    $(document).ready(function() {
        $('.btn-delete').click(function(e) {
            e.preventDefault();
            const userId = $(this).data('campus-id');
            if (confirm('Are you sure you want to delete this campus?')) {
                $.ajax({
                    url: '/campuses/' + campusId,
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


