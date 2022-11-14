@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'dashboard'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats rounded">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <div class="icon-big text-center">
                                    <i class="nc-icon nc-money-coins text-success"></i>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="numbers">
                                    <p class="card-category">Total Sales</p>
                                    <p class="card-title">₱ {{ number_format($monthly_sale, 2, '.', ',') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <hr>
                        <div class="stats">
                            <i class="nc-icon nc-alert-circle-i"></i>
                            Lifetime
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats rounded">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <div class="icon-big text-center">
                                    <i class="nc-icon nc-single-copy-04 text-warning"></i>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="numbers">
                                    <p class="card-category">Total Orders</p>
                                    <p class="card-title">{{ $monthly_order  }}<p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <hr>
                        <div class="stats">
                            <i class="nc-icon nc-alert-circle-i"></i>
                            Lifetime
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats rounded">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <div class="icon-big text-center">
                                    <i class="nc-icon nc-single-02 text-info"></i>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="numbers">
                                    <p class="card-category">Total Users</p>
                                    <p class="card-title">{{ $total_users }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <hr>
                        <div class="stats">
                            <i class="nc-icon nc-alert-circle-i"></i>
                            Lifetime
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats rounded">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <div class="icon-big text-center">
                                    <i class="nc-icon nc-box text-danger"></i>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="numbers">
                                    <p class="card-category">Total Packages</p>
                                    <p class="card-title">{{ $total_packages }}<p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <hr>
                        <div class="stats">
                            <i class="nc-icon nc-alert-circle-i"></i>
                            Lifetime
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title text-muted">Monthly Users Chart</h5>
                            <form action="{{ 'home' }}" method="GET" style="width:15rem;">
                                <label>Filter by Year</label>
                                <div class="input-group">
                                    <select id="inputGroupSelect04" class="custom-select" name="filter_users_year">
                                        <option disabled selected>Select Year</option>
                                        @foreach ($years as $year)
                                            @if (request()->get('filter_users_year') == $year->year)
                                                <option value="{{ $year->year }}" selected>{{ $year->year }}</option>
                                            @else
                                                <option value="{{ $year->year }}">{{ $year->year }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <div class="input-group-append">
                                        <button class="btn btn-default m-0" type="submit">Filter</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chartWrapper">
                            <div class="chartAreaWrapper">
                                <canvas id="monthlyUsersChart" height="400"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title text-muted">Monthly Sales Chart</h5>
                            <form action="{{ 'home' }}" method="GET" style="width:15rem;">
                                <label>Filter by Year</label>
                                <div class="input-group">
                                    <select id="inputGroupSelect04" class="custom-select" name="filter_sales_year">
                                        <option disabled selected>Select Year</option>
                                        @foreach ($order_years as $year)
                                            @if (request()->get('filter_sales_year') == $year->year)
                                                <option value="{{ $year->year }}" selected>{{ $year->year }}</option>
                                            @else
                                                <option value="{{ $year->year }}">{{ $year->year }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <div class="input-group-append">
                                        <button class="btn btn-default m-0" type="submit">Filter</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chartWrapper">
                            <div class="chartAreaWrapper">
                                <canvas id="monthlySalesChart" height="400"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="row">
            <div class="col-md-4">
                <div class="card ">
                    <div class="card-header">
                        <h5 class="card-title">Email Statistics</h5>
                        <p class="card-category">Last Campaign Performance</p>
                    </div>
                    <div class="card-body">
                    </div>
                    <div class="card-footer">
                        <div class="legend">
                            <i class="fa fa-circle text-primary"></i> Opened
                            <i class="fa fa-circle text-warning"></i> Read
                            <i class="fa fa-circle text-danger"></i> Deleted
                            <i class="fa fa-circle text-gray"></i> Unopened
                        </div>
                        <hr>
                        <div class="stats">
                            <i class="fa fa-calendar"></i> Number of emails sent
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card card-chart">
                    <div class="card-header">
                        <h5 class="card-title">NASDAQ: AAPL</h5>
                        <p class="card-category">Line Chart with Points</p>
                    </div>
                    <div class="card-body">
                    </div>
                    <div class="card-footer">
                        <div class="chart-legend">
                            <i class="fa fa-circle text-info"></i> Tesla Model S
                            <i class="fa fa-circle text-warning"></i> BMW 5 Series
                        </div>
                        <hr />
                        <div class="card-stats">
                            <i class="fa fa-check"></i> Data information certified
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            
            const chart_labels = [
                'January',
                'February',
                'March',
                'April',
                'May',
                'June',
                'July',
                'August',
                'September',
                'October',
                'November',
                'December'
            ];

            // Monthly Users Chart

            const monthly_users_datasets = [{
                label: 'Users by Month',
                backgroundColor: 'rgb(81, 188, 218)',
                data: {!! $monthly_users_data !!},
            }]

            const monthly_users_data = {
                labels: chart_labels,
                datasets: monthly_users_datasets
            }

            const monthly_users_chart = new Chart(
                document.querySelector('#monthlyUsersChart'),
                {
                    type: 'bar',
                    data: monthly_users_data,
                    options: {
                        scales: {
                            xAxes: [{
                                ticks: {
                                    fontSize: 12,
                                    display: true,
                                    autoSkip: false,
                                    maxTicksLimit: 12
                                }
                            }],
                            yAxes: [{
                                display: true,
                                ticks: {
                                    suggestedMin: 0,
                                    beginAtZero: true
                                }
                            }]
                        },
                        legend: {
                            display: true,
                            position: 'bottom',
                            align: 'start'
                        },
                        responsive: true,
                        maintainAspectRatio: false,
                    }
                }) 


            // Monthly Sales Chart
            
            const monthly_sales_datasets = [{
                label: 'Sales by Month',
                backgroundColor: 'rgb(107, 208, 152)',
                data: {!! $monthly_sales_data !!},
            }]

            const monthly_sales_data = {
                labels: chart_labels,
                datasets: monthly_sales_datasets
            }

            const monthly_sales_chart = new Chart(
                document.querySelector('#monthlySalesChart'),
                {
                    type: 'bar',
                    data: monthly_sales_data,
                    options: {
                        scales: {
                            xAxes: [{
                                ticks: {
                                    fontSize: 12,
                                    display: true,
                                    autoSkip: false,
                                    maxTicksLimit: 12
                                }
                            }],
                            yAxes: [{
                                display: true,
                                ticks: {
                                    suggestedMin: 0,
                                    beginAtZero: true
                                }
                            }]
                        },
                        legend: {
                            display: true,
                            position: 'bottom',
                            align: 'start'
                        },
                        responsive: true,
                        maintainAspectRatio: false,
                    }
                })
                
        });
    </script>
@endpush