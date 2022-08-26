@extends('layouts.app', [
    'class' => 'lock-page',
    'elementActive' => '',
    'backgroundImagePath' => ''
])

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb" class="mt-5">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('welcome') }}" class="text-muted">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('shop.index') }}" class="text-muted">Store</a>
                </li>
                <li class="breadcrumb-item">
                    <a class="text-muted">Package</a>
                </li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-md-8 col-sm-12 mx-auto">
                <h5 class="mt-5">Customize your package!</h5>
                <hr>
                @foreach ($package as $p)
                    <div class="card border rounded bg-light">
                        <div class="card-body">
                            <div class="container">
                                <div class="text-center">
                                    <h4 class="card-title">{{ $p->name }}</h4>
                                    <p>{{ $p->user }}</p>
                                </div>
                                <hr class="hr-text" data-content="Customize Food Menu">
                                <div>
                                    <div id="package-items">
                                        @foreach ($categoryRules as $cr)
                                            @if ($cr->package_id == $p->id)
                                            <p class="mb-0">{{ $cr->category_name }}</p>
                                            <small class="mb-1 text-muted">(Choose {{ $cr->quantity }} item/s)</small>
                                            <p class="ml-3 font-italic font-weight-light">
                                                @for ($i = 0; $i < $cr->quantity; $i++)
                                                <div class="form-group">
                                                    <select class="form-control" id="exampleFormControlSelect1">
                                                        @foreach ($items as $item)
                                                            @if ($item->category_id == $cr->category_id)
                                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @endfor                                                    
                                            </p>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                <div class="text-center">
                                    <h4 id="package-price" class="mb-0">₱ {{ number_format($p->price, 2, '.', ',') }}</h4>
                                    <span>{{ $p->pax }} PAX</span>
                                </div>
                                <hr class="bg-secondary">
                                <div id="package-info">
                                    <div class="row">
                                        <div class="col-2 text-right">
                                            <span class="nc-icon nc-pin-3"/>
                                        </div>
                                        <small class="col-10 text-left">{{ $p->address }}</small>
                                    </div>
                                    <div class="row my-2">
                                        <div class="col-2 text-right">
                                            <span class="nc-icon nc-send"/>
                                        </div>
                                        <small class="col-10 text-left">+63 {{ $p->phone }}</small>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button class="btn btn-success">Proceed to Checkout</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(() => {
            
        })
    </script>
@endpush