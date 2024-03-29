@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'item'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Inventory</li>
                        <li class="breadcrumb-item">Package Items</li>
                        <li class="breadcrumb-item active">Edit Package Item</li>
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
                            <h5 class="mb-0">Edit Package Item</h5>
                            <a href="{{ route('item.index') }}" class="btn btn-sm btn-default">Back</a>
                        </div>
                        <form action="{{ route('item.update', ['item' => $item->id]) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label for="name">Enter Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Item's Name" value="{{ $item->name }}">
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="name">Enter Description</label>
                                <textarea class="form-control" name="description" cols="30" rows="10" placeholder="Item's Description">{{ $item->description }}</textarea>
                                @if ($errors->has('description'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="category">Select Category</label>
                                <select class="form-control" name="category_id" value="{{ $item->category_id }}">
                                  <option selected></option>
                                  @foreach ($category as $c)
                                    @if ($c->id == $item->category_id)
                                        <option value="{{ $c->id }}" selected>{{ $c->name }}</option>
                                    @else
                                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                                    @endif
                                  @endforeach
                                </select>
                                @if ($errors->has('category_id'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('category_id') }}</strong>
                                    </span>
                                @endif
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
    </div>
@endsection

@push('scripts')
    
@endpush