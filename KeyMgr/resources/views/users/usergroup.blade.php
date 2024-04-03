@extends ("adminlte::page")
@section('title', __('User Groups'))

@section('content_header')
    <h1>User Groups</h1>
@stop

@section('content')

@section('plugins.Datatables', true)

<x-adminlte-card theme="info" theme-mode="outline" title="Add New Group" collapsible>
{{--<div class="col-sm-4">--}}
    <div class="row">
<form action="/groups" method="POST">
  @csrf
  <x-adminlte-select name="parentGroup" label="Parent Group" label-class="info">
    <x-slot name="prependSlot">
      <div class="input-group-text bg-info">
        <i class="fas fa-users"></i>
      </div>
    </x-slot>
    <x-adminlte-options :options="$groups"/>
  </x-adminlte-select>

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
</div>
<div class="row">
  <div class="col-sm-3">

    <button type="submit" class="btn btn-block btn-primary">Submit</button>
  </div>
</div>
</form>
{{--</div>--}}
</x-adminlte-card>


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
