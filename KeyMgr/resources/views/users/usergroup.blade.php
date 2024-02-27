<!-- <h1>User Group Data</h1>
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
@endif -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add or Delete Groups</title>
</head>
<body>

<h1>Add or Delete Groups</h1>

<ul id="dataList">
    @foreach ($groups as $group)
        <li>
            {{ $group['name'] }}
            <button class="deleteGroup" data-group-id="{{ $group['id'] }}">Delete</button>
        </li>
    @endforeach
</ul>

<input type="text" id="newGroupName" placeholder="Enter group name">
<button onclick="addGroup()">Add Group</button>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function addGroup() {
        var groupName = $('#newGroupName').val();
        if (groupName.trim() === '') {
            alert('Please enter a group name');
            return;
        }

        $.ajax({
            url: '{{ route('groups.store') }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                name: groupName
            },
            success: function(response) {
                $('#dataList').append('<li>' + groupName + '<button class="deleteGroup" data-group-id="' + response.group_id + '">Delete</button></li>');
                $('#newGroupName').val('');
            },
            error: function(xhr) {
                console.log(xhr.responseText);
                alert('Failed to add group. Please try again.');
            }
        });
    }

    $(document).on('click', '.deleteGroup', function() {
        var groupId = $(this).data('group-id');
        var listItem = $(this).closest('li');

        $.ajax({
            url: '{{ route('groups.destroy', ['group' => $group['id']]) }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                id: groupId
            },
            success: function(response) {
                listItem.remove();
            },
            error: function(xhr) {
                console.log(xhr.responseText);
                alert('Failed to delete group. Please try again.');
            }
        });
    });
</script>

</body>
</html>
