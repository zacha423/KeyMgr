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

<h1>Blade Data</h1>
@if(isset($groupsJSON))
<h2>groups/groupsJSON</h2>
{{ $groupsJSON }}
@endif
@if(isset($groupJSON))
<h2>group/groupJSON</h2>
{{ $groupJSON }}
@endif

@stop

