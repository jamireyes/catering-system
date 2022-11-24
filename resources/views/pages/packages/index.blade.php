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
                        <a class="btn btn-info mr-2" href="{{ route('package.create') }}" role="button">Add Package</a>
                        {{ $packages->links() }}
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach ($packages as $package)
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="package card border rounded">
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
@endsection

@push('scripts')
    <script>
        $(document).ready(() => {
            $('ul.pagination').addClass('mb-0 mr-4');
        })
    </script>
@endpush