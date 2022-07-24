@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'user'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col">
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
                    
                    <div class="col-12"></div>

                    <div class="card-body">
                        <form>
                            <div class="form-row">
                                <div class="form-group col-md-8">
                                    <label for="name">Full Name</label>
                                    <input type="text" class="form-control" id="name" placeholder="Juan Dela Cruz">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="role">Role</label>
                                    <select id="role" class="form-control">
                                        <option selected>Select role...</option>
                                        <option value="ADMIN">ADMIN</option>
                                        <option value="USER">USER</option>
                                        <option value="SELLER">SELLER</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" placeholder="juandelacruz@mail.com">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" placeholder="Password">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address_1">Address Line 1</label>
                                <input type="text" class="form-control" id="address_1" placeholder="1234 Main St">
                            </div>
                            <div class="form-group">
                                <label for="address_2">Address Line 2</label>
                                <input type="text" class="form-control" id="address_2" placeholder="Apartment, studio, or floor">
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="city">City</label>
                                    <input type="text" class="form-control" id="city">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="province">Province</label>
                                    <input type="text" class="form-control" id="province">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="zipcode">Zipcode</label>
                                    <input type="text" class="form-control" id="zipcode">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="gender">Select Gender</label>
                                    <div class="form-check pl-2 mb-0">
                                        <input class="form-check-input ml-0" type="radio" name="gender" id="gender1" value="MALE">
                                        <label class="form-check-label" for="gender1">
                                          Male
                                        </label>
                                    </div>
                                    <div class="form-check pl-2">
                                        <input class="form-check-input ml-0" type="radio" name="gender" id="gender2" value="FEMALE">
                                        <label class="form-check-label" for="gender2">
                                          Female
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center">
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
        $(document).ready(() => {

        })
    </script>
@endpush