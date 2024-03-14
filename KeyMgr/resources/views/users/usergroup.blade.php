<h1>User Group Data</h1>
<form action="/groups" method="POST">
  @csrf
  <div>
  <select name="parentGroup">
    @if(isset($groups))
    @foreach($groups as $group)
      <option value="{{$group['id']}}">{{$group['name']}}</option>
    @endforeach
    @endif
</select>  Parent Group
</div>
<div>
  <input type="text" name="groupName">Group Name</input>
  </div>
  <div>
    <input type="submit"></input>
  </div>
</form>

<h1>Blade Data</h1>
@if(isset($groupsJSON))
<h2>groups/groupsJSON</h2>
{{ $groupsJSON }}
@endif
@if(isset($groupJSON))
<h2>group/groupJSON</h2>
{{ $groupJSON }}
@endif
