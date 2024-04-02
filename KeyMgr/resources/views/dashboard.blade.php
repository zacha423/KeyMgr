@extends('adminlte::page')
@section('title', __('Dashboard'))


@section('content_header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@stop

@section ("content")

<div class="row">
    <div class="col-lg-3 col-6">
        
        <div class="small-box bg-info">

            <div class="inner">
                <h3>OVER 9000!!!!</h3>
                <p>Keys</p>
            </div>
            <div class="icon">
                <!-- Icon for keys goes here -->
            </div>
            <a href="/keys" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>

    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>597</h3>
                <p>Doors</p>
            </div>
            <div class="icon">
                <!-- Icon for doors goes here -->
            </div>
            <a href="/doors" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>44</h3>
                <p>Key Requests</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>3,000</h3>
                <p>People</p>
            </div>
            <div class="icon">
                <!-- Icon for people goes here -->
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header border-transparent">
        <h3 class="card-title">Recent Activity</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table m-0">
                <thead>
                    <tr>
                        <th>Transaction ID</th>
                        <th>Key</th>
                        <th>User</th>
                        <th>Location</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><a href="#">#####</a></td>
                        <td>New Key</td>
                        <td>Bobby</td>
                        <td>
                            Nah
                        </td>
                    </tr>
                    <tr>
                        <td><a href="#">#####</a></td>
                        <td>WOW KEY</td>
                        <td>Bob the Great</td>
                        <td>
                            Huh
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card-footer clearfix">
        <a href="#" class="btn btn-sm btn-secondary float-right">View All Activity</a>
    </div>
</div>


@stop