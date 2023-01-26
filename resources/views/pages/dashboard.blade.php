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
                                    <i class="nc-icon nc-money-coins text-info"></i>
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
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats rounded">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <div class="icon-big text-center">
                                    <i class="nc-icon nc-single-copy-04 text-danger"></i>
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
                </div>
            </div>
            @if (Auth::user()->role != 'SELLER') 
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats rounded">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <div class="icon-big text-center">
                                    <i class="nc-icon nc-single-02 text-warning"></i>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="numbers">
                                    <p class="card-category">Total Customers</p>
                                    <p class="card-title">{{ $total_users }}</p>
                                </div>
                            </div>
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
                                    <i class="nc-icon nc-box text-success"></i>
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
                </div>
            </div>
            @endif
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="sale-profit-chart card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="text-muted text-lg mb-0">Monthly Sales and Profit Chart</h5>
                            <button class="btn btn-sm btn-icon btn-default m-0" onclick="downloadPDF('monthlySalesChart', 'sale-profit-chart')">
                                <svg viewBox="0 0 24 24" width="17" height="17" stroke="currentColor" stroke-width="2.7" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                            </button>
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
            <div class="col-md-6">
                @if (Auth::user()->role == 'SELLER')
                    <div class="user-order-chart card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="text-muted text-lg mb-0">Monthly Orders Chart</h5>
                                <button class="btn btn-sm btn-icon btn-default m-0" onclick="downloadPDF('monthlyOrdersChart', 'user-order-chart')">
                                    <svg viewBox="0 0 24 24" width="17" height="17" stroke="currentColor" stroke-width="2.7" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chartWrapper">
                                <div class="chartAreaWrapper">
                                    <canvas id="monthlyOrdersChart" height="400"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif (Auth::user()->role == 'ADMIN')
                    <div class="user-order-chart card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="text-muted text-lg mb-0">Monthly Customers and Orders Chart</h5>
                                <button class="btn btn-sm btn-icon btn-default m-0" onclick="downloadPDF('monthlyUsersChart', 'user-order-chart')">
                                    <svg viewBox="0 0 24 24" width="17" height="17" stroke="currentColor" stroke-width="2.7" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                                </button>
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
                @endif
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.2.146/pdf.min.js" integrity="sha512-hA0/Bv8+ywjnycIbT0xuCWB1sRgOzPmksIv4Qfvqv0DOKP02jSor8oHuIKpweUCsxiWGIl+QaV0E82mPQ7/gyw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js"></script>
    @if (Auth::user()->role == 'SELLER')
        <script>
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

            const bgColor = {
                id: 'bgColor',
                beforeDraw: (chart, options) => {
                    const { ctx, width, height } = chart
                    ctx.fillStyle = 'white'
                    ctx.fillRect(0, 0, width, height)
                    ctx.restore()
                }
            }

            const monthly_sales_chart = new Chart(document.querySelector('#monthlySalesChart'), {
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
                },
                plugins: [bgColor]
            })

            const monthly_orders_datasets = [
                {
                    label: 'Total Orders',
                    backgroundColor: '#ef8157',
                    data: {!! $monthly_total_orders !!},
                }
            ]

            const monthly_orders_data = {
                labels: chart_labels,
                datasets: monthly_orders_datasets
            }

            const monthly_orders_chart = new Chart(document.querySelector('#monthlyOrdersChart'), {
                type: 'bar',
                data: monthly_orders_data,
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
                },
                plugins: [bgColor]
            })

            const year = ($('[name="filter_year"]').val() != null) ? $('[name="filter_year"]').val() : '';

            if(year.length != 0){
                $('.sale-profit-chart h5').append(' ('+year+')')
                $('.user-order-chart h5').append(' ('+year+')')
            }

            function downloadPDF(id, cardName){
                const card = document.querySelector('.'+cardName+' h5').innerText
                const canvas = document.querySelector('#'+id)
                const canvasImage = canvas.toDataURL('image/jpeg', 1.0)

                let pdf = new jsPDF('landscape')
                pdf.setFontSize(15)
                pdf.addImage(canvasImage, 'JPEG', 15, 35, 250, 150)
                pdf.text(15, 20, card)
                pdf.save('monthly-sales-chart.pdf')
            }
        </script>
    @elseif (Auth::user()->role == 'ADMIN')
        <script>  
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
                    label: 'Total Orders',
                    backgroundColor: '#ef8157',
                    data: {!! $monthly_total_orders !!},
                },
                {
                    label: 'Total Users',
                    backgroundColor: '#fbc658',
                    data: {!! $monthly_users_data !!},
                },
            ]

            const monthly_users_data = {
                labels: chart_labels,
                datasets: monthly_users_datasets
            }

            const bgColor = {
                id: 'bgColor',
                beforeDraw: (chart, options) => {
                    const { ctx, width, height } = chart
                    ctx.fillStyle = 'white'
                    ctx.fillRect(0, 0, width, height)
                    ctx.restore()
                }
            }

            const monthly_users_chart = new Chart(document.querySelector('#monthlyUsersChart'), {
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
                },
                plugins: [bgColor]
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

            const sales_canvas = document.querySelector('#monthlySalesChart');
            salesContext = sales_canvas.getContext('2d');

            const monthly_sales_chart = new Chart(
                salesContext,
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
                    },
                    plugins: [bgColor]
                })
            
            const year = ($('[name="filter_year"]').val() != null) ? $('[name="filter_year"]').val() : '';

            if(year.length != 0){
                $('.sale-profit-chart h5').append(' ('+year+')')
                $('.user-order-chart h5').append(' ('+year+')')
            } 

            monthly_sales_chart.defaults.global = {
                scaleFontSize: 600
            }

            monthly_users_chart.defaults.global = {
                scaleFontSize: 600
            }
            
            function downloadPDF(id, cardName){
                const card = document.querySelector('.'+cardName+' h5').innerText
                const canvas = document.querySelector('#'+id)
                const canvasImage = canvas.toDataURL('image/jpeg', 1.0)

                let pdf = new jsPDF('landscape')
                pdf.setFontSize(15)
                pdf.addImage(canvasImage, 'JPEG', 15, 35, 250, 150)
                pdf.text(15, 20, card)
                pdf.save('monthly-sales-chart.pdf')
            }
        </script>
    @endif
@endpush