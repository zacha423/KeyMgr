@extends('adminlte::page')
@section('title', __('Dashboard'))

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>


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
                <h3>{{$counts['keys']}}</h3>
                <p>Keys</p>
            </div>
            <div class="icon">
                <i class="fas fa-fw fa-key"></i>
            </div>
            <a href="/keys" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>

    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{$counts['locks']}}</h3>
                <p>Locks</p>
            </div>
            <div class="icon">
                <i class="fas fa-fw fa-door-open"></i>
            </div>
            <a href="/door" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{$counts['key_requests']}}</h3>
                <p>Key Authorizations</p>
            </div>
            <div class="icon">
                <i class="fas fa-fw fa-file-signature"></i>
            </div>
            <a href="/authorizations" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{$counts['users']}}</h3>
                <p>People</p>
            </div>
            <div class="icon">
                <i class="fas fa-fw fa-users"></i>
            </div>
            <a href="/users" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
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
                                <th>Authorization ID</th>
                                <th>Date</th>
                                <th>Requestor</th>
                                <th>Key</th>
                                <th>Holder</th>
                                <th>Location</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($keyAuthorizations as $authorization)
                            <tr>
                                <td><a href="/authorizations/{{ $authorization['id'] }}">{{ $authorization['id'] }}</a></td>
                                <td>{{ $authorization['date'] }}</td>
                                <td>{{ $authorization['admin'] }}</td>
                                <td>{{ $authorization['key'] }}</td>
                                <td>{{ $authorization['user'] }}</td>
                                <td>{{ $authorization['location'] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer clearfix">
                <a href="/authorizations" class="btn btn-sm btn-secondary float-right">View All Authorizations</a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-lightblue disabled">
                    <div class="card-header">
                        <h3 class="card-title">Key Statuses</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="pieChart1" style="min-height: 250px; height: 450px; max-height: 250px; max-width: 100%; display: block; width: 500px;" width="1000" height="800" class="chartjs-render-monitor"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card card-olive disabled">
                    <div class="card-header">
                        <h3 class="card-title">Authorization Statuses</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="pieChart2" style="min-height: 250px; height: 450px; max-height: 250px; max-width: 100%; display: block; width: 500px;" width="1000" height="800" class="chartjs-render-monitor"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




@stop

@section('js')
    <script>
        $(function () {
            /* ChartJS
            * -------
            * Pie Chart using ChartJS
            */

            //-------------
            //- PIE CHART -
            //-------------
            // Get context with jQuery - using jQuery's .get() method.
            
            var pieChartCanvas1 = $('#pieChart1').get(0).getContext('2d')
            var pieChartCanvas2 = $('#pieChart2').get(0).getContext('2d')
            var pieData1 = @json($pieData1);
            var pieData2 = @json($pieData2);
            var pieOptions     = {
            maintainAspectRatio : false,
            responsive : true,
            }

            //Create pie or donut chart
            // You can switch between pie and donut using the method below.
            new Chart(pieChartCanvas1, {
            type: 'pie',
            data: pieData1,
            options: pieOptions
            })

            new Chart(pieChartCanvas2, {
            type: 'pie',
            data: pieData2,
            options: pieOptions
            })
        })
    </script>
@stop