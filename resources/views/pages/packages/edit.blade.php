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
                        <li class="breadcrumb-item"><a href="{{ route('package.index') }}">Packages</a></li>
                        <li class="breadcrumb-item active">Edit Package</li>
                    </ol>
                </nav>
                @include('components.alerts')
            </div>
        </div>          
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h5 class="mb-0">Edit Package</h5>
                            <a href="{{ route('package.index') }}" class="btn btn-sm btn-default">Back</a>
                        </div>
                        @foreach ($packages as $package)
                        <form action="{{ route('package.update', ['package' => $package->id]) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label for="name">Enter Package's Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Package's Name" value="{{ $package->name }}">
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="inclusion">Enter Package's Inclusions</label>
                                <input type="text" class="form-control" name="inclusion" placeholder="Package's Inclusions" value="{{ $package->inclusion }}">
                                @if ($errors->has('inclusion'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('inclusion') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="pax">Enter Number of Person/s (PAX)</label>
                                    <input type="number" class="form-control" name="pax" placeholder="Number of Person/s" value="{{ $package->pax }}">
                                    @if ($errors->has('pax'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('pax') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="price">Enter Package's Price</label>
                                    <input type="number" class="form-control" name="price" placeholder="Package's Price" value="{{ $package->price }}">
                                    @if ($errors->has('price'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('price') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <hr class="hr-text" data-content="Set Category Limits">
                            <div class="form-row">
                                @foreach ($categories as $c)
                                    <div class="form-group col-4">
                                        <label>{{ $c->name }}</label>
                                        <select name="quantity[]" class="form-control" value="{{ $c->quantity }}">
                                            @for($x = 1; $x < 6; $x++)
                                                @if($c->quantity == $x)
                                                    <option selected value="{{ $c->quantity }}">{{ $c->quantity }}</option>
                                                @else
                                                <option value="{{ $x }}">{{ $x }}</option>
                                                @endif
                                            @endfor
                                        </select>
                                        <input name="category[]" type="hidden" class="form-control" value="{{ $c->id }}">
                                        @if ($errors->has('quantity[]'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('quantity[]') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                            
                            <div class="d-flex justify-content-center">
                                <button type="reset" class="btn btn-warning">Reset</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>                
    </div>
@endsection