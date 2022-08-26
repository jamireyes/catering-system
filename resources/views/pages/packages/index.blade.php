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
                        <a class="btn btn-primary" href="{{ route('package.create') }}" role="button">Add Package</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach ($packages as $package)
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card border rounded">
                    <div class="card-body">
                        <div class="container">
                            <div class="text-center">
                                <h4 class="card-title text-warning">{{ $package->name }}</h4>
                                <p>{{ $package->user }}</p>
                            </div>
                            <hr class="bg-warning">
                            <div id="package-menu">
                                <div id="package-items">
                                    @foreach ($categoryRules as $cr)
                                        @if ($cr->package_id == $package->id)
                                        <p class="mb-0">{{ $cr->category_name }}</p>
                                        <small class="mb-1 text-muted">(Max {{ $cr->quantity }} item/s)</small>
                                        <p class="ml-3 font-italic font-weight-light">
                                            @foreach ($items as $item)
                                                @if ($item->category_id == $cr->category_id)
                                                    {{ $item->name }}
                                                @endif
                                            @endforeach
                                        </p>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="text-center">
                                <h4 id="package-price" class="mb-0">₱ {{ number_format($package->price, 2, '.', ',') }}</h4>
                                <span>{{ $package->pax }} PAX</span>
                            </div>
                            <hr class="bg-warning">
                            <div id="package-info">
                                <div class="row">
                                    <div class="col-2 text-right">
                                        <span class="nc-icon nc-pin-3"/>
                                    </div>
                                    <small class="col-10 text-left">{{ $package->address }}</small>
                                </div>
                                <div class="row my-2">
                                    <div class="col-2 text-right">
                                        <span class="nc-icon nc-send"/>
                                    </div>
                                    <small class="col-10 text-left">+63 {{ $package->phone }}</small>
                                </div>
                            </div>
                        </div>                        
                        <div class="d-flex justify-content-center mt-4">
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