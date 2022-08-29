@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'user'
])

@section('content')
    <div class="content">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Add User Account</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('user.index') }}" class="btn btn-sm btn-dark">Back</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="addUser" action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <hr class="hr-text" data-content="Personal Information">
                            <div class="form-group">
                                <label for="name">Full Name <i>(Example: Juan Dela Cruz)</i></label>
                                <input type="text" class="form-control" name="name">
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="email">Email <i>(Example: sample@mail.com)</i></label>
                                    <input type="email" class="form-control" name="email">
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" name="password">
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="phone_number">Phone Number <i>(Example: 0917 135 8000)</i></label>
                                    <input type="text" class="form-control" name="phone_number">
                                    @if ($errors->has('phone_number'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('phone_number') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="role">Role <i>(Admin, User, Seller)</i></label>
                                    <select name="role" class="form-control">
                                        <option selected disabled="disabled"></option>
                                        <option value="ADMIN">ADMIN</option>
                                        <option value="USER">USER</option>
                                        <option value="SELLER">SELLER</option>
                                    </select>
                                    @if ($errors->has('role'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('role') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <hr class="hr-text" data-content="Permanent Address">

                            <div class="form-group">
                                <label for="address_1">Address Line 1</label>
                                <input type="text" class="form-control" name="address_1">
                                @if ($errors->has('address_1'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('address_1') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="address_2">Address Line 2</label>
                                <input type="text" class="form-control" name="address_2">
                                @if ($errors->has('address_2'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('address_2') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="city">City</label>
                                    <input type="text" class="form-control" name="city">
                                    @if ($errors->has('city'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('city') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="state">Province</label>
                                    <input type="text" class="form-control" name="state">
                                    @if ($errors->has('state'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('state') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="zipcode">Zipcode</label>
                                    <input type="text" class="form-control" name="zipcode">
                                    @if ($errors->has('zipcode'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('zipcode') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-center my-4">
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
    <script>
        $('select[name="role"]').on('change', function() {
            if(this.value == 'SELLER'){
                $('label[for="name"]').html('Company Name ')
                $('label[for="name"]').append('<i>(Example: Three Catering Services Inc.)</i>');
            }else{
                $('label[for="name"]').html('Full Name ')
                $('label[for="name"]').append('<i>(Example: Juan Dela Cruz)</i>');
            }
        });
    </script>
@endpush