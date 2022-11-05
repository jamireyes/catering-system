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
                        <div class="stats sales-desc">
                            <i class="nc-icon nc-calendar-60"></i>
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
                                    <p class="card-category">Monthly Orders</p>
                                    <p class="card-title">{{ $monthly_order  }}<p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <hr>
                        <div class="stats order-desc">
                            <i class="nc-icon nc-calendar-60"></i>
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
            <div class="col-md-12">
                {{-- <div class="card rounded">
                    <div class="card-header ">
                        <h5 class="card-title">Users Behavior</h5>
                        <p class="card-category">24 Hours performance</p>
                    </div>
                    <div class="card-body ">
                        <canvas id=chartHours width="400" height="100"></canvas>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <div class="stats">
                            <i class="fa fa-history"></i> Updated 3 minutes ago
                        </div>
                    </div>
                </div> --}}
                <div class="card">
                    <div class="card-header ">
                        <h5 class="card-title">Monthly New Users</h5>
                        {{-- <p class="card-category">2022</p> --}}
                    </div>
                    <div class="card-body">
                        <div class="chartWrapper">
                            <div class="chartAreaWrapper">
                                <canvas id="monthlyUsersChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card ">
                    <div class="card-header ">
                        <h5 class="card-title">Email Statistics</h5>
                        <p class="card-category">Last Campaign Performance</p>
                    </div>
                    <div class="card-body ">
                        {{-- <canvas id="chartEmail"></canvas> --}}
                    </div>
                    <div class="card-footer ">
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
                        {{-- <canvas id="speedChart" width="400" height="100"></canvas> --}}
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
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            // Javascript method's body can be found in assets/assets-for-demo/js/demo.js
            // demo.initChartsPages();

            const currentMonth = new Date().toLocaleString('default', {month: 'long'})

            $('.sales-desc').append('For ' + currentMonth)
            $('.order-desc').append('For ' + currentMonth)

            const monthly_users_label = {!! $monthly_users_label !!};
            const monthly_users_datasets = [
                {
                    label: 'Users by Month',
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: {!! $monthly_users_data !!},
                }
            ]

            const data = {
                labels: monthly_users_label,
                datasets: monthly_users_datasets
            }

            const config = {
                type: 'bar',
                data: data,
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
                }
            }

            const monthly_users_chart = new Chart(
                document.querySelector('#monthlyUsersChart'),
                config
            ) 
        });
    </script>
@endpush