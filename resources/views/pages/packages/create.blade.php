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
                        <li class="breadcrumb-item active">Add Package</li>
                    </ol>
                </nav>
                @include('components.alerts')
            </div>
        </div>
        @isset($categories)
            @if($categories->isNotEmpty())            
                <div class="row">
                    <div class="col-md-6 mx-auto">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h5 class="mb-0">Add Package</h5>
                                    <a href="{{ route('package.index') }}" class="btn btn-sm btn-default">Back</a>
                                </div>
                                <form action="{{ route('package.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Enter Package's Name</label>
                                        <input type="text" class="form-control" name="name" placeholder="Package's Name" value="">
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="pax">Enter Number of Person/s (PAX)</label>
                                            <input type="number" class="form-control" name="pax" placeholder="Number of Person/s" value="">
                                            @if ($errors->has('pax'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('pax') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="price">Enter Package's Price</label>
                                            <input type="number" class="form-control" name="price" placeholder="Package's Price" value="">
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
                                                <select name="quantity[]" class="form-control">
                                                    <option selected disabled="disabled">Select category limit</option>
                                                    <option value="0">0</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
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
                            </div>
                        </div>
                    </div>
                </div>                
            @endif
        @endisset
    </div>
@endsection