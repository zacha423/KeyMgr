@extends("adminlte::page")

@section('title', 'Groups | ' . $group['name'])

@section('content_header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Group Details | {{ $group['name'] }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('groups.index') }}">Groups</a></li>
                        <li class="breadcrumb-item active">{{ $group['name'] }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@stop

@section("content")
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="m-0">Group Information</h5>
                            <div class="btn-group">
                                <a href="{{ route('groups.edit', ['group' => $group['id']]) }}" data-toggle="modal" data-target="#updateGroupModal" id="newGroup" name="newGroup" class="btn btn-info mr-1"><i class="fas fa-edit"></i> Edit</a>
                                @include('users.groups.updateGroupModal', ['options' => $groups, 'title' => 'Group Update Form'])
                                <form action="{{ route('groups.destroy', ['group' => $group['id']]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p><strong>Parent Group:</strong> 
                            @if($group['parent'])
                                <a href="{{ route('groups.show', ['group' => $group['parent']['id']]) }}">
                                    {{ $group['parent']['name'] }}
                                </a>
                            @else
                                Parent information not available
                            @endif
                        </p>

                        @if(count($group['children']) > 0)
                            <p><strong>Child Groups:</strong></p>
                            <ul>
                                @foreach($group['children'] as $child)
                                    <li>
                                        <a href="{{ route('groups.show', ['group' => $child['id']]) }}">
                                            {{ $child['name'] }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p>No child groups available.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="m-0">Users Assigned Group: <strong>{{ $group['name'] }}</strong></h5>
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('users.index') }}">View all Users</a></li>
                </ol>
            </div>
            <div class="card-body">
                @include('users.partials.usersAssignedGroupTable')
            </div>
        </div>
    </div>
</div>
@stop
