@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'user'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-4 h-100">
                <div class="card shadow">
                    <div class="card-header">
                        <div class="d-flex flex-row align-items-center justify-content-between">
                            <h4 class="card-title">Update User Account</h4>
                            <button class="btn btn-sm btn-round btn-icon btn-outline-primary">
                                <svg height="15" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-row justify-content-between">
                            <small class="text-sm text-muted">Date Created:</small>
                            <small id="created_at" class="text-sm text-muted"></small>
                        </div>
                        <div class="d-flex flex-row justify-content-between">
                            <small class="text-sm text-muted">Last Update:</small>
                            <small id="updated_at" class="text-sm text-muted"></small>
                        </div>
                        <form id="userAccount">
                            <p class="text-muted mt-4">Personal Information</p>
                            <div class="form-group row">
                                <label for="name" class="col-sm-3 col-form-label">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="name" placeholder="Name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="gender" class="col-sm-3 col-form-label">Gender</label>
                                <div class="col-sm-9">
                                    <select id="gender" class="form-control">
                                        <option value="MALE">MALE</option>
                                        <option value="FEMALE">FEMALE</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="email" placeholder="Email Address">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="phone_number" class="col-sm-3 col-form-label">Contact No.</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="phone_number" placeholder="Contact Number">
                                </div>
                            </div>
                            <p class="text-muted mt-5">Permanent Address</p>
                            <div class="form-group row">
                                <label for="address_1" class="col-sm-3 col-form-label">Address</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="address_1" placeholder="Address Line 1">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="address_2" class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="address_2" placeholder="Address Line 2">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="city" class="col-sm-3 col-form-label">City</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="city" placeholder="City">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="province" class="col-sm-3 col-form-label">Province</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="province" placeholder="Province">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="zipcode" class="col-sm-3 col-form-label">Zipcode</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="zipcode" placeholder="Zipcode">
                                </div>
                            </div>
                            <div class="d-flex justify-content-center my-4">
                                <button class="btn btn-warning">Update User</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('user.create') }}" class="btn btn-sm btn-primary">Add user</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table userDatatable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script>
    <script>
        $(document).ready(() => {

            // Initialize userDatatable
            var table = $('.userDatatable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: "{{ route('user.index') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'role', name: 'role'},
                    {data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-right'},
                ],
                select: true,
            })

            // Auto-populate "Update User Account" card upon selecting a row in the userDatatable
            $('.userDatatable tbody').on( 'click', 'tr', function () {
                const rowData = table.row(this).data()

                $('.userDatatable').DataTable.$('tr.selected').removeClass('selected')
                $(this).addClass('selected')
                $('#userAccount input').attr('readonly', 'readonly');
                $('#userAccount #gender').attr("disabled", true); 

                $('#name').val(rowData.name)
                $('#email').val(rowData.email)
                $('#role').val(rowData.role)
                $('#gender').val(rowData.gender)
                $('#address_1').val(rowData.address_1)
                $('#address_2').val(rowData.address_2)
                $('#city').val(rowData.city)
                $('#province').val(rowData.province)
                $('#zipcode').val(rowData.zipcode)
                $('#phone_number').val(rowData.phone_number)

                if(!$('#created_at').is(':empty') && !$('#updated_at').is(':empty')){
                    $('#created_at').empty();
                    $('#updated_at').empty();
                }
                $('#created_at').append(moment(rowData.created_at).format('MMMM Do YYYY, h:mm:ss a'))
                $('#updated_at').append(moment(rowData.updated_at).format('MMMM Do YYYY, h:mm:ss a'))
            } );

            
            $(document).on('click', '#delete-btn', function() {
                var id = $(this).data('id')
                var url = "user/"+id;
                console.log(url)

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You are about to DELETE a user.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'DELETE',
                            url: url,
                            data: {'_token' : "{{csrf_token() }}"},
                            success: () => {
                                $(".userDatatable").DataTable().ajax.reload();
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                )
                            },
                            error: (err) => {
                                alert(err);
                            }
                        });
                    }
                })
            })

            $(document).on('click', '#restore-btn', function() {
                var id = $(this).data('id')
                var url = "user/"+id+"/restore";
                console.log(url)

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You are about to RESTORE a user.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, restore it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'POST',
                            url: url,
                            data: {'_token' : "{{csrf_token() }}"},
                            success: () => {
                                $(".userDatatable").DataTable().ajax.reload();
                                Swal.fire(
                                    'Restored!',
                                    'Your file has been restored.',
                                    'success'
                                )
                            },
                            error: (err) => {
                                alert(err);
                            }
                        });
                    }
                })
            })

        })
    </script>
@endpush