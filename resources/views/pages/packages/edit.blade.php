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
                        @foreach ($packages as $p)
                        <form action="{{ route('package.update', ['package' => $p->id]) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="name">Title</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ $p->name }}" name="name" required>
                                    @if ($errors->has('name') && !$errors->has('occasion'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="d-flex justify-content-between">
                                        <label for="occasion">Occasion</label>
                                        <label>Not in the list? <a href="#" data-toggle="modal" data-target="#add-occasion-modal">Add Occasion!</a></label>
                                    </div>
                                    <select class="form-control @error('occasion') is-invalid @enderror" name="occasion" required>
                                        <option selected></option>
                                        @foreach ($occasions as $o)
                                            @if ($p->occasion_id == $o->id)
                                                <option value="{{ $o->id }}" selected>{{ $o->name }}</option>   
                                            @else
                                                <option value="{{ $o->id }}">{{ $o->name }}</option>                                                
                                            @endif
                                        @endforeach
                                    </select>
                                    @if ($errors->has('occasion'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('occasion') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inclusion">Inclusions</label>
                                <input type="text" class="form-control @error('inclusion') is-invalid @enderror" name="inclusion" value="{{ $p->inclusion }}" required>
                                @if ($errors->has('inclusion'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('inclusion') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="pax">PAX</label>
                                    <input type="number" class="form-control @error('pax') is-invalid @enderror" name="pax" min="0" oninput="this.value = Math.abs(this.value)" value="{{ $p->pax }}" required>
                                    @if ($errors->has('pax'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('pax') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="price">Price</label>
                                    <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" min="0" oninput="this.value = Math.abs(this.value)" value="{{ $p->price }}" required>
                                    @if ($errors->has('price'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('price') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="discount">Discount</label>
                                    <div class="input-group mb-3">
                                        <input type="number" class="form-control @error('discount') is-invalid @enderror" name="discount" min="0" oninput="this.value = Math.abs(this.value)" value="{{ $p->discount }}" required>
                                        <div class="input-group-append">
                                          <span class="input-group-text px-2 py-0 bg-light" id="basic-addon2">%</span>
                                        </div>
                                    </div>
                                    @if ($errors->has('discount'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('discount') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <hr class="hr-text" data-content="Set Category Limits">
                            <div class="form-row">
                                @foreach ($categories as $c)
                                    <div class="form-group col-4">
                                        <label>{{ $c->name }}</label>
                                        <input name="quantity[]" type="number" class="form-control" value="{{ $c->quantity }}" required>
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
        <div id="add-occasion-modal" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="{{ route('occasion.store') }}" method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title">Enter Occasion</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @csrf
                            <div class="form-group">
                                <label for="name">Occasion</label>
                                <input type="text" class="form-control" name="occasion">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>               
    </div>
@endsection