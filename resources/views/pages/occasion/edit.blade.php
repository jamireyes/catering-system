@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'occasion'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item">Occasion</li>
                        <li class="breadcrumb-item active">Add Occasion</li>
                    </ol>
                </nav>
                @include('components.alerts')
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-2 d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="mb-0 text-capitalize">{{ __('Edit Occasion') }}</h5>
                            </div>
                            <a href="{{ route('occasion.index') }}" class="btn btn-sm btn-default">Back</a>
                        </div>
                        <form action="{{ route('occasion.update', ['occasion' => $occasion->id]) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label for="name">Edit Occasion Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Name of Occasion" value="{{ $occasion->name }}">
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
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
