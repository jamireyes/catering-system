@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'user'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">User Management</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-header">
                        <div class="d-flex flex-row align-items-center justify-content-between">
                            <h5 class="card-title">Update User Account</h5>
                            <button id="lock-btn" class="btn btn-round btn-icon btn-primary">
                                <img src="{{ asset('assets')}}/img/svg/lock.svg" class="lock-icon">
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-row justify-content-between">
                            <small class="text-sm text-muted">Created on:</small>
                            <small id="created_at" class="text-sm text-muted"></small>
                        </div>
                        <div class="d-flex flex-row justify-content-between">
                            <small class="text-sm text-muted">Last Update:</small>
                            <small id="updated_at" class="text-sm text-muted"></small>
                        </div>
                        <form id="userAccount" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <p class="text-muted mt-4">Personal Information</p>
                            <div class="form-group row">
                                <label for="name" class="col-sm-3 col-form-label">Name</label>
                                <div class="col-sm-9">
                                    <input readonly type="text" class="form-control" id="name" name="name" placeholder="">
                                    <input type="hidden" id="id" name="id">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input readonly type="text" class="form-control" id="email" name="email" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="phone_number" class="col-sm-3 col-form-label">Contact No.</label>
                                <div class="col-sm-9">
                                    <input readonly type="text" class="form-control" id="phone_number" name="phone_number" placeholder="">
                                </div>
                            </div>
                            <p class="text-muted mt-5">Permanent Address</p>
                            <div class="form-group row">
                                <label for="address_1" class="col-sm-3 col-form-label">Address</label>
                                <div class="col-sm-9">
                                    <input readonly type="text" class="form-control" id="address_1" name="address_1" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="address_2" class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <input readonly type="text" class="form-control" id="address_2" name="address_2" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="city" class="col-sm-3 col-form-label">City</label>
                                <div class="col-sm-9">
                                    <input readonly type="text" class="form-control" id="city" name="city" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="state" class="col-sm-3 col-form-label">Province</label>
                                <div class="col-sm-9">
                                    <input readonly type="text" class="form-control" id="state" name="state" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="zipcode" class="col-sm-3 col-form-label">Zipcode</label>
                                <div class="col-sm-9">
                                    <input readonly type="text" class="form-control" id="zipcode" name="zipcode" placeholder="">
                                </div>
                            </div>
                            <div class="form-check text-left mt-4">
                                <label class="form-check-label">
                                    <input class="form-check-input" id="agreement" type="checkbox" required>
                                    <span class="form-check-sign"></span>
                                        {{ __('I agree to the') }}
                                    <a href="#something">{{ __('terms and conditions') }}</a>.
                                </label>
                            </div>
                            <div class="d-flex justify-content-center my-4">
                                <button id="updateUser" type="button" class="btn btn-warning">Update User</button>
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
                        <div class="table-responsive-sm">
                            <table class="table table-bordered userDatatable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
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

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

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

            function reloadTable(){
                $(".userDatatable").DataTable().ajax.reload();
            }

            // Auto-populate "Update User Account" card upon selecting a row in the userDatatable
            $('.userDatatable tbody').on( 'click', 'tr', function () {
                const rowData = table.row(this).data()

                lockBtn()

                $('.userDatatable').DataTable.$('tr.selected').removeClass('selected')
                $(this).addClass('selected')

                $('#id').val(rowData.id)
                $('#name').val(rowData.name)
                $('#email').val(rowData.email)
                $('#role').val(rowData.role)
                $('#address_1').val(rowData.address_1)
                $('#address_2').val(rowData.address_2)
                $('#city').val(rowData.city)
                $('#state').val(rowData.state)
                $('#zipcode').val(rowData.zipcode)
                $('#phone_number').val("0"+rowData.phone_number)

                console.log(rowData)

                if(!$('#created_at').is(':empty') && !$('#updated_at').is(':empty')){
                    $('#created_at').empty();
                    $('#updated_at').empty();
                }
                $('#created_at').append(moment(rowData.created_at).format('MMMM Do YYYY'))
                $('#updated_at').append(moment(rowData.updated_at).format('MMMM Do YYYY'))
            });

            const lock = "{{ asset('assets')}}"+"/img/svg/lock.svg"
            const unlock = "{{ asset('assets')}}"+"/img/svg/unlock.svg"

            function lockBtn() {
                $('#lock-btn').removeClass('btn-warning').addClass('btn-primary')
                $('#lock-btn img').attr('src', lock)
                $('#userAccount input').attr('readonly', 'readonly');
                $('#userAccount #gender').attr("disabled", true); 
            }

            function unlockBtn() {
                $('#lock-btn').removeClass('btn-primary').addClass('btn-warning')
                $('#lock-btn img').attr('src', unlock)
                $('#userAccount input').removeAttr('readonly');
                $('#userAccount #gender').removeAttr('disabled'); 
            }

            // To lock or unlock the input fields for user account update
            $('#lock-btn').click(function(){
                if($(this).hasClass('btn-primary')){
                    unlockBtn()
                }else{
                    lockBtn()
                }
            })

            $('#updateUser').click(function(e){
                e.preventDefault()
                var id = $('#id').val()
                var url = '{{ route("user.update", ":id") }}';

                url = url.replace(':id', id);

                if($('#agreement:checked').length != 0){
                    console.log('hello')
                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: $('#userAccount').serialize(),
                        success: () => {
                            lockBtn()
                            reloadTable()
                            Swal.fire(
                                'User Updated!',
                                'User account has been updated.',
                                'success'
                            )
                        },
                        error: (err) => {
                            const errors = err.responseJSON.errors
                            var html = ''

                            Object.values(errors).forEach(val => {
                                html += "<p>"+val[0]+"</p>"
                            })

                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                html: html,
                            })
                        }   
                    })
                }
            })

            $(document).on('click', '#delete-btn', function() {
                var id = $(this).data('id')
                var url = "user/"+id;

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
                                reloadTable()
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
                                reloadTable()
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