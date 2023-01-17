@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'dashboard'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col">
                <div class="d-flex justify-content-between">
                    <h5 class="text-muted mb-0">Dashboard</h5>
                    <form action="{{ 'home' }}" method="GET" style="width:14rem;">
                        <div class="input-group mb-0">
                            <select id="inputGroupSelect04" class="custom-select" name="filter_year" style="height: 2rem;">
                                <option disabled selected>Select Year</option>
                                @for ($x = Carbon\Carbon::now()->year; $x >= ((Carbon\Carbon::now()->year) - 5); $x--)
                                    @if (request()->get('filter_year') == $x)
                                        <option value="{{ $x }}" selected>{{ $x }}</option>
                                    @else
                                        <option value="{{ $x }}">{{ $x }}</option>
                                    @endif
                                @endfor
                            </select>
                            <div class="input-group-append">
                                <button class="btn btn-sm btn-default m-0" type="submit">Filter Year</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <hr>
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
                <div class="sale-profit-chart card">
                    <div class="card-header">
                        <h5 class="text-muted text-lg">Monthly Sales and Profit Chart</h5>
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
            <div class="col-md-6">
                <div class="user-order-chart card">
                    <div class="card-header">
                        <h5 class="text-muted text-lg">Monthly Users and Orders Chart</h5>
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
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            $('[data-toggle="tooltip"]').tooltip()

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

            const monthly_users_datasets = [
                {
                    label: 'Total Users',
                    backgroundColor: '#fbc658',
                    data: {!! $monthly_users_data !!},
                },
                {
                    label: 'Total Orders',
                    backgroundColor: '#ef8157',
                    data: {!! $monthly_total_orders !!},
                },
            ]

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
            
            const monthly_sales_datasets = [
                {
                    label: 'Total Sales',
                    backgroundColor: '#51bcda',
                    data: {!! $monthly_total_sales !!},
                },
                {
                    label: 'Total Profits',
                    backgroundColor: 'rgb(107, 208, 152)',
                    data: {!! $monthly_total_profits !!},
                },
            ]

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

            // sale-profit-chart
            // user-order-chart
            console.log($('[name="filter_year"]').val(), $('.sale-profit-chart h5'));
            
            const year = ($('[name="filter_year"]').val() != null) ? $('[name="filter_year"]').val() : '';

            $('.sale-profit-chart h5').append(' '+year)
            $('.user-order-chart h5').append(' '+year)
        });
    </script>
@endpush