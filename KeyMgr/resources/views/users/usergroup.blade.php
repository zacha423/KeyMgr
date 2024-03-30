@extends ("adminlte::page")
@section ("content")

<h1>User Group Data</h1>
<div class="col-sm-6">
<form action="/groups" method="POST">
  @csrf
  <label for="parentGroup">Parent Group</label>
  <div class="form-group">
  <select name="parentGroup" class="form-control">
    @if(isset($groups))
        @foreach($groups as $group)
            <option value="{{$group['id']}}">{{$group['name']}}</option>
        @endforeach
    @endif
</select>

</div>
<div class="form-group">
  <label for="inputGroup">Group Name</label>
  <input type="text" class="form-control" name="groupName" placeholder="Enter group name">
  </div>
  <div class="col-sm-3">

    <button type="submit" class="btn btn-block btn-primary">Submit</button>
  </div>
</form>
</div>

@section('plugins.Datatables', true)
<div class="flex-container">
  @include('users.partials.grouptable')
</div>
@stop

<script>
    $(document).ready(function() {
        $('.btn-delete').click(function(e) {
            e.preventDefault();
            const userId = $(this).data('group-id');
            if (confirm('Are you sure you want to delete this group?')) {
                $.ajax({
                    url: '/group/' + groupId,
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
