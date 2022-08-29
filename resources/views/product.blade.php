@extends('layouts.app', [
    'class' => 'lock-page',
    'elementActive' => '',
    'backgroundImagePath' => ''
])

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb" class="mt-4">
                    <ol class="breadcrumb bg-white border rounded-0">
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
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h5 class="mt-5">Customize your package!</h5>
                <hr>
                @foreach ($package as $p)
                    <div class="card border rounded bg-light">
                        <div class="card-body">
                            <form id="productForm" action="{{ route('checkout.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $p->id }}">
                                <input type="hidden" name="name" value="{{ $p->name }}">
                                <input type="hidden" name="pax" value="{{ $p->pax }}">
                                <input type="hidden" name="price" value="{{ $p->price }}">
                                <input type="hidden" name="inclusion" value="{{ $p->inclusion }}">
                                <input type="hidden" name="user" value="{{ $p->user }}">
                                
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
                                                <input type="hidden" name="category[]" value='{"id": "{{ $cr->category_id }}", "name": "{{ $cr->category_name }}"}'>
                                                <p class="mb-0">{{ $cr->category_name }}</p>
                                                <small class="mb-1 text-muted">(Choose {{ $cr->quantity }} item/s)</small>
                                                <p class="ml-3 font-italic font-weight-light">
                                                    <div class="form-row">
                                                        @for ($i = 0; $i < $cr->quantity; $i++)
                                                        <div class="form-group col">
                                                            <select class="form-control" name="items[]" id="exampleFormControlSelect1">
                                                                @foreach ($items as $item)
                                                                    @if ($item->category_id == $cr->category_id)
                                                                        <option value='{"id":"{{ $item->id }}","name":"{{ $item->name }}", "category_id": "{{ $cr->category_id }}"}'>{{ $item->name }}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        @endfor                                                    
                                                    </div>
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
                                        <button type="submit" class="btn btn-success">Proceed to Checkout</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#productForm').on('submit', function(e){
                e.preventDefault();
                $.ajax({
                    url: {{ route('checkout.store') }},
                    dataType : "json",
                    contentType: "application/json; charset=utf-8",
                    type: 'POST',
                    data: JSON.stringify($(this).serialize()),
                })
            })
        })
    </script>
@endpush