@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'package'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Packages</li>
                    </ol>
                </nav>
                @include('components.alerts')
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">All Packages</h5>
                    <div class="d-flex justify-content-center align-items-center">
                        {{ $packages->links() }}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 mt-4">
                <ul class="nav nav-pills" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="pill" href="#home" role="tab" aria-controls="home" aria-selected="true">Table</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="preview-tab" data-toggle="pill" href="#preview" role="tab" aria-controls="preview" aria-selected="false">Preview</a>
                    </li>
                    <li class="nav-item ml-auto">
                        <a class="nav-link bg-primary text-white" href="{{ route('package.create') }}" role="button">Add Package</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        
                        <div class="card">
                            <div class="card-body p-3">
                                <div class="table-responsive-sm">
                                    <table class="table table-bordered mb-0">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No.</th>
                                                <th>Name</th>
                                                @if (Auth::user()->role == 'ADMIN')
                                                <th>Catering Service</th>
                                                @endif
                                                <th>Cost Price</th>
                                                <th>Selling Price</th>
                                                <th>Discount</th>
                                                <th>Created On</th>
                                                <th>Last Update</th>
                                                <th class="text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($packages as $p)
                                                <tr>
                                                    <th scope="row" class="text-center">{{ $loop->iteration }}</th>
                                                    <td>{{ $p->name }}</td>
                                                    @if (Auth::user()->role == 'ADMIN')
                                                    <td>{{ $p->user }}</td>
                                                    @endif
                                                    <td>{{ $p->cost_price }}</td>
                                                    <td>{{ $p->price }}</td>
                                                    @if ($p->discount)
                                                        <td>{{ $p->discount }}</td>
                                                    @else
                                                        <td>N/A</td>
                                                    @endif
                                                    <td>{{ Carbon\Carbon::parse($p->created_at)->toFormattedDateString() }}</td>
                                                    <td>{{ Carbon\Carbon::parse($p->updated_at)->toFormattedDateString() }}</td>
                                                    <td>
                                                        <div class="d-flex justify-content-center">
                                                            @if($p->deleted_at == NULL)
                                                                <form action="{{ route('package.edit', ['package' => $p->id]) }}" method="GET">
                                                                    <button type="submit" class="btn btn-sm btn-warning mr-2" title="Edit">
                                                                        <div class="d-flex justify-content-center align-items center">
                                                                            <svg viewBox="0 0 24 24" height="1.2rem" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                                                        </div>
                                                                    </button>
                                                                </form>
                                                                <form action="{{ route('package.destroy', ['package' => $p->id]) }}" method="POST">
                                                                    @method('delete')
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                                                        <div class="d-flex justify-content-center align-items center">
                                                                            <svg viewBox="0 0 24 24" height="1.2rem" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path><line x1="18" y1="9" x2="12" y2="15"></line><line x1="12" y1="9" x2="18" y2="15"></line></svg>
                                                                        </div>
                                                                    </button>
                                                                </form>
                                                            @else
                                                                <form action="{{ route('package.restore', ['package' => $p->id]) }}" method="POST">
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-sm btn-info" title="Restore">
                                                                        <div class="d-flex justify-content-center align-items center">
                                                                            <svg viewBox="0 0 24 24" height="1.2rem" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><polyline points="1 4 1 10 7 10"></polyline><polyline points="23 20 23 14 17 14"></polyline><path d="M20.49 9A9 9 0 0 0 5.64 5.64L1 10m22 4l-4.64 4.36A9 9 0 0 1 3.51 15"></path></svg>
                                                                        </div>
                                                                    </button>
                                                                </form>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="preview" role="tabpanel" aria-labelledby="preview-tab">
                        <div class="row">
                            @foreach ($packages as $package)
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="package card border rounded shadow-lg">
                                        <div class="card-body">
                                            <div class="m-2">
                                                <div class="text-center">
                                                    <h5 class="card-title">{{ $package->name }}</h5>
                                                    <p class="text-xs">{{ $package->user }}</p>
                                                </div>
                                                <hr class="bg-warning">
                                                <div id="package-menu">
                                                    <div id="package-items">
                                                        @foreach ($categoryRules as $cr)
                                                            @if ($cr->package_id == $package->id)
                                                            <p class="mb-0 text-xs">{{ $cr->category_name }}</p>
                                                            <small class="mb-1 text-muted">(Max {{ $cr->quantity }} item/s)</small>
                                                            <p class="ml-3 text-xs font-italic font-weight-light">
                                                                @foreach ($items as $item)
                                                                    @if ($item->category_id == $cr->category_id)
                                                                        {{ $item->name }},
                                                                    @endif
                                                                @endforeach
                                                                etc
                                                            </p>
                                                            @endif
                                                        @endforeach
                                                        @if($package->inclusion)
                                                            <p class="mb-0 text-xs">{{ __('Inclusions') }}</p>
                                                            <p class="ml-3 text-xs font-italic font-weight-light">{{ $package->inclusion }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="m-0 d-flex flex-column justify-content-center align-items-center" style="height:5rem;">
                                                    @if ($package->discount)
                                                        <p class="text-muted mb-0"><del>₱ {{ $package->price }}</del></p>
                                                        <h5 id="package-price" class="mb-0">₱ {{ number_format(($package->price * (1 - $package->discount / 100)), 2, '.', ',') }}</h5>
                                                    @else
                                                        <h5 id="package-price" class="mb-0">₱ {{ number_format($package->price, 2, '.', ',') }}</h5>
                                                    @endif
                                                    <span>{{ $package->pax }} PAX</span>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-center">
                                                @if($package->deleted_at == NULL)
                                                    <form action="{{ route('package.edit', ['package' => $package->id]) }}" method="GET">
                                                        <button type="submit" class="btn btn-sm btn-warning">Edit</button>
                                                    </form>
                                                    <form action="{{ route('package.destroy', ['package' => $package->id]) }}" method="POST">
                                                        @method('delete')
                                                        @csrf
                                                        <button class="btn btn-sm btn-danger">Delete</button>
                                                    </form>
                                                @else
                                                    <form action="{{ route('package.restore', ['package' => $package->id]) }}" method="POST">
                                                        @csrf
                                                        <button class="btn btn-sm btn-primary">Restore</button>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(() => {
            $('ul.pagination').addClass('mb-0 mr-4');
        })
    </script>
@endpush