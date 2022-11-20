@extends('layouts.app', [
    'class' => 'lock-page',
    'elementActive' => '',
    'backgroundImagePath' => ''
])

@section('content')
    @foreach ($package as $p)
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('welcome') }}" class="text-muted">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('shop.index') }}" class="text-muted">Store</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a class="text-muted">{{ $p->name }}</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <form id="productForm" action="{{ route('checkout.store') }}" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col">            
                    <div class="card border rounded">
                        <div class="p-4">
                            @csrf
                            <input type="hidden" name="id" value="{{ $p->id }}">
                            <input type="hidden" name="name" value="{{ $p->name }}">
                            <input type="hidden" name="pax" value="{{ $p->pax }}">
                            <input type="hidden" name="price" value="{{ $p->price }}">
                            <input type="hidden" name="inclusion" value="{{ $p->inclusion }}">
                            <input type="hidden" name="user" value="{{ $p->user }}">
                            
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
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border rounded">
                        <div class="p-4">
                            <div class="d-flex justify-content-between">
                                <p class="mb-0">{{ $p->name }}</p>
                                <p class="mb-0">{{ $p->pax }} PAX</p>
                            </div>
                            <hr>
                            <table class="product-details">
                                <tr>
                                    <td><i class="nc-icon nc-shop"></i></td>
                                    <td>{{ $p->user }}</td>
                                </tr>
                                <tr>
                                    <td><i class="nc-icon nc-pin-3"></i></td>
                                    <td>{{ $p->address }}</td>
                                </tr>
                                <tr>
                                    <td><i class="nc-icon nc-send"></i></td>
                                    <td>0{{ $p->phone }}</td>
                                </tr>
                                <tr>
                                    <td><i class="nc-icon nc-email-85"></i></td>
                                    <td>{{ $p->email }}</td>
                                </tr>
                            </table>
                            <hr>
                            <table class="product-summary">
                                <tr>
                                    <td>Subtotal</td>
                                    <td>₱ {{ number_format($p->price, 2, '.', ',') }}</td>
                                </tr>
                                <tr>
                                    <td>Discount</td>
                                    <td>--</td>
                                </tr>
                                <tr class="grand-total">
                                    <td>Grand Total</td>
                                    <td>₱ {{ number_format($p->price, 2, '.', ',') }}</td>
                                </tr>
                            </table>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success">Go to checkout</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @endforeach
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