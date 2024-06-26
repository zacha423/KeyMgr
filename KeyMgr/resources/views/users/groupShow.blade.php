@extends("adminlte::page")
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
@section('plugins.Datatables', true)
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="m-0">Group Information</h5>
                            <div class="btn-group">
                                <x-adminlte-button type="button" theme="info" data-toggle="modal" data-target="#updateGroupModal" id="newGroup" name="newGroup"  label="Edit" icon="fas fa-edit"></x-adminlte-button>
                                @include('users.groups.updateGroupModal', ['options' => $groups, 'title' => 'Group Update Form'])
                                <form id="delForm" name="delForm" action="{{ route('groups.destroy', ['group' => $group['id']]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')                                    
                                </form>
                                <x-adminlte-button type="submit" theme="danger" label="Delete" icon="fas fa-trash-alt" form="delForm"/>
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
@if(isset($open))
<script>
    $(() => {
        $(window).load($('#updateGroupModal').modal('show'));
    });
</script>
@endif
@stop