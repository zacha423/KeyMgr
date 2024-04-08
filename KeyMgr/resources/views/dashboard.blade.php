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
                <!-- Icon for keys goes here -->
            </div>
            <a href="/keys" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>

    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{$counts['doors']}}</h3>
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
                <h3>{{$counts['key_requests']}}</h3>
                <p>Key Requests</p>
            </div>
            <div class="icon">
                <!-- Icon for key requests goes here -->
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{$counts['users']}}</h3>
                <p>People</p>
            </div>
            <div class="icon">
                <!-- Icon for people goes here -->
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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
                        
                        <th>Transaction ID</th>
                        <th>Date</th>
                        <th>Key</th>
                        <th>User</th>
                        <th>Location</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><a href="#">#####</a></td>
                        <td>Sun Apr 07, 2024 7:06AM</td>
                        <td>New Key</td>
                        <td>Bobby</td>
                        <td>
                            Nah
                        </td>
                    </tr>
                    <tr>
                        <td><a href="#">#####</a></td>
                        <td>Sun Apr 07, 2024 7:06AM</td>
                        <td>WOW KEY</td>
                        <td>Bob the Great</td>
                        <td>
                            Huh
                        </td>
                    </tr>
                    <tr>
                        <td><a href="#">#####</a></td>
                        <td>Sun Apr 07, 2024 7:06AM</td>
                        <td>WOW KEY</td>
                        <td>Bob the Great</td>
                        <td>
                            Huh
                        </td>
                    </tr>
                    <tr>
                        <td><a href="#">#####</a></td>
                        <td>Sun Apr 07, 2024 7:06AM</td>
                        <td>WOW KEY</td>
                        <td>Bob the Great</td>
                        <td>
                            Huh
                        </td>
                    </tr>
                    <tr>
                        <td><a href="#">#####</a></td>
                        <td>Sun Apr 07, 2024 7:06AM</td>
                        <td>WOW KEY</td>
                        <td>Bob the Great</td>
                        <td>
                            Huh
                        </td>
                    </tr>
                    <tr>
                        <td><a href="#">#####</a></td>
                        <td>Sun Apr 07, 2024 7:06AM</td>
                        <td>WOW KEY</td>
                        <td>Bob the Great</td>
                        <td>
                            Huh
                        </td>
                    </tr>
                    <tr>
                        <td><a href="#">#####</a></td>
                        <td>Sun Apr 07, 2024 7:06AM</td>
                        <td>WOW KEY</td>
                        <td>Bob the Great</td>
                        <td>
                            Huh
                        </td>
                    </tr>
                    <tr>
                        <td><a href="#">#####</a></td>
                        <td>Sun Apr 07, 2024 7:06AM</td>
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
</div>


<div class="col-md-4">
    <div class="card card-danger">
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
            <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 322px;" width="644" height="500" class="chartjs-render-monitor"></canvas>
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
            
            var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
            var pieData = @json($pieData);
            var pieOptions     = {
            maintainAspectRatio : false,
            responsive : true,
            }

            //Create pie or donut chart
            // You can switch between pie and donut using the method below.
            new Chart(pieChartCanvas, {
            type: 'pie',
            data: pieData,
            options: pieOptions
            })
        })
    </script>
@stop