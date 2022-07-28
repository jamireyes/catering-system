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
                            <div class="form-row">
                                <div class="form-group col-md-8">
                                    <label for="name">Full Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Juan Dela Cruz">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="role">Role</label>
                                    <select name="role" class="form-control">
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
                                    <input type="email" class="form-control" name="email" placeholder="juandelacruz@mail.com">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" name="password" placeholder="Password">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address_1">Address Line 1</label>
                                <input type="text" class="form-control" name="address_1" placeholder="1234 Main St">
                            </div>
                            <div class="form-group">
                                <label for="address_2">Address Line 2</label>
                                <input type="text" class="form-control" name="address_2" placeholder="Apartment, studio, or floor">
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="gender">Gender</label>
                                    <div class="form-check pl-2 mb-0">
                                        <input class="form-check-input ml-0" type="radio" id="gender1" name="gender" value="MALE">
                                        <label class="form-check-label" for="gender1">
                                          Male
                                        </label>
                                    </div>
                                    <div class="form-check pl-2">
                                        <input class="form-check-input ml-0" type="radio" id="gender2" name="gender" value="FEMALE">
                                        <label class="form-check-label" for="gender2">
                                          Female
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="button" class="btn btn-primary">Submit</button>
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