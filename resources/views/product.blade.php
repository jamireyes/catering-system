@extends('layouts.app', [
    'class' => 'lock-page',
    'elementActive' => '',
    'backgroundImagePath' => ''
])

@section('content')
    @foreach ($package as $p)
    <div class="container">
        <div class="row mt-4">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('welcome') }}" class="text-muted">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('shop.index') }}" class="text-muted">Packages</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('store.show', ['store' => $p->cater_id]) }}">{{ $p->name }}</a>
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
                            <input type="hidden" name="discount" value="{{ $p->discount }}">
                            <input type="hidden" name="price" value="{{ $p->price }}">
                            <input type="hidden" name="inclusion" value="{{ $p->inclusion }}">
                            <input type="hidden" name="user" value="{{ $p->user }}">
                            
                            <div id="package-items">
                                @foreach ($categoryRules as $cr)
                                    @if ($cr->package_id == $p->id)
                                    <input type="hidden" name="category[]" value='{"id": "{{ $cr->category_id }}", "name": "{{ $cr->category_name }}"}'>
                                    <p class="mb-0">{{ $cr->category_name }}</p>
                                    <small class="mb-1 text-muted">(Choose {{ $cr->quantity }} item/s)</small>
                                    <div class="form-row my-3">
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
                                    @endif
                                @endforeach
                                <hr class="my-4">
                                @if ($p->inclusion)
                                    <p class="mb-0">Inclusions</p>
                                    <p class="text-muted font-weight-light mt-1 mb-0">{{ $p->inclusion }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="card border rounded">
                        <div class="p-4">
                            <div class="d-flex justify-content-between">
                                <p class="text-dark mb-0">{{ $p->name }}</p>
                                <p class="mb-0">{{ $p->pax }} PAX</p>
                            </div>
                            <div class="my-2">
                                <a class="fav-btn @if($favorite != NULL) active @endif" data-store="{{ route('favorite.store') }}" data-destroy="{{ route('favorite.destroy', ['favorite' => $p->id]) }}">
                                    <span></span>
                                    Add to Favorites
                                </a>
                            </div>
                            <hr>
                            <table class="product-details">
                                <tr>
                                    <td><i class="nc-icon nc-shop"></i></td>
                                    <td>
                                        <a class="text-dark" href="{{ route('store.show', ['store' => $p->cater_id]) }}">
                                            <u>{{ $p->user }}</u>
                                        </a>
                                    </td>
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
                                    @if ($p->discount)
                                        <td>Discount ({{ $p->discount }}% OFF)</td>
                                        <td>- {{ number_format(($p->price * ($p->discount / 100)), 2, '.', ',') }}</td>
                                    @else
                                        <td>Discount</td>
                                        <td>--</td>
                                    @endif
                                </tr>
                                <tr class="grand-total">
                                    <td>Grand Total</td>
                                    <td>₱ {{ number_format(($p->price * (1 - $p->discount / 100)), 2, '.', ',') }}</td>
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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })

        $(document).ready(function() {
            $('.fav-btn').click(function(){
                const store_route = $(this).data('store')
                const destroy_route = $(this).data('destroy')
                const package_id = $('[name="id"]').val()

                if({{ Auth::check() }}){
                    if($(this).hasClass('active')){
                        $.ajax({
                            url: destroy_route,
                            type: 'POST',
                            dataType: 'JSON',
                            data: {
                                '_method': 'DELETE'
                            },
                            success: (data) => {
                                console.log(data)
                                $(this).toggleClass('active')
                            }
                        })
                    }else{
                        $.ajax({
                            url: store_route,
                            type: 'POST',
                            dataType: 'JSON',
                            data: {
                                'user_id': {{ Auth::id() }},
                                'package_id': package_id
                            },
                            success: (data) => {
                                $(this).toggleClass('active')
                            }
                        })
                    }
                }
            })
        })
    </script>
@endpush