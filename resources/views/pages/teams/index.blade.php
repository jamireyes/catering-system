@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'team'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item active">Teams</li>
                    </ol>
                </nav>
                @include('components.alerts')
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="text-xl mb-0">Teams</h5>
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#AddTeamModal">Add Team</button>
                </div>
            </div>
        </div>
        <div class="row">
            @isset($teams)
                @foreach ($teams as $team)
                    <div class="col-md-4">
                        <div class="team-card card text-left">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <p class="m-0">Order No: {{ $team->order_id }}</p>
                                    <div class="form-inline">
                                        <button class="add-member-btn btn btn-xs btn-default m-0" data-id="{{ $team->id }}" title="Add Member">Add Member</button>
                                        @if ($team->deleted_at != NULL)
                                            <form action="{{ route('team.restore', ['team' => $team->id]) }}" method="POST">
                                                @csrf
                                                <button class="btn btn-xs btn-info m-0 ml-1" title="Restore Team">Restore Team</button>
                                            </form>
                                        @else
                                            <form action="{{ route('team.destroy', ['team' => $team->id]) }}" method="POST">
                                                @method('delete')
                                                @csrf
                                                <button class="btn btn-xs btn-danger m-0 ml-1" title="Remove Team">Remove Team</button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <hr class="m-0">
                            <div class="card-body" style="height: 22.75rem; max-height: 25rem; overflow-x:auto;">
                                <div class="table-responsive-sm">
                                    <table class="team-table table table-borderless">
                                        <thead>
                                            <tr>
                                                <th scope="col">Name</th>
                                                <th scope="col">Role</th>
                                                <th scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <form action="{{ route('member.store') }}" method="POST">
                                                @csrf
                                                <tr class="add-member-form-{{ $team->id }}" style="display: none;">
                                                    <td>
                                                        <input type="text" class="form-control" name="name" required>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" name="role" required>
                                                    </td>
                                                    <td>
                                                        <input type="hidden" name="team_id" value="{{ $team->id }}">
                                                        <button type="submit" class="btn btn-sm btn-info btn-icon m-0"><i class="fa-solid fa-plus"></i></button>
                                                    </td>
                                                </tr>
                                            </form>
                                            @foreach ($members as $member)
                                                @if ($team->id == $member->team_id)
                                                    <tr>
                                                        <td>{{ $member->name }}</td>
                                                        <td>{{ $member->role }}</td>
                                                        <td>
                                                            <div class="d-flex justify-content-end">
                                                                @if ($member->deleted_at != NULL)
                                                                    <form action="{{ route('member.restore', ['member' => $member->id]) }}" method="POST">
                                                                        @csrf
                                                                        <button type="submit" class="btn btn-sm btn-icon btn-info" title="Restore Member">
                                                                            <div class="d-flex justify-content-center align-items center">
                                                                                <svg viewBox="0 0 24 24" height="1.2rem" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><polyline points="1 4 1 10 7 10"></polyline><polyline points="23 20 23 14 17 14"></polyline><path d="M20.49 9A9 9 0 0 0 5.64 5.64L1 10m22 4l-4.64 4.36A9 9 0 0 1 3.51 15"></path></svg>
                                                                            </div>
                                                                        </button>
                                                                    </form>
                                                                @else
                                                                    <button class="btn btn-sm btn-icon btn-warning mr-2" title="Edit Member" data-toggle="modal" data-target="#EditTeamModal" data-route="{{ route('member.update', ['member' => $member->id]) }}" data-name="{{ $member->name }}" data-role="{{ $member->role }}" data-order_id="{{ $team->order_id }}">
                                                                        <div class="d-flex justify-content-center align-items center">
                                                                            <svg viewBox="0 0 24 24" height="1.2rem" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                                                        </div>
                                                                    </button>
                                                                    <form action="{{ route('member.destroy', ['member' => $member->id]) }}" method="POST">
                                                                        @method('delete')
                                                                        @csrf
                                                                        <button type="submit" class="btn btn-sm btn-icon btn-danger" title="Remove Member">
                                                                            <div class="d-flex justify-content-center align-items center">
                                                                                <svg viewBox="0 0 24 24" height="1.2rem" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path><line x1="18" y1="9" x2="12" y2="15"></line><line x1="12" y1="9" x2="18" y2="15"></line></svg>
                                                                            </div>
                                                                        </button>
                                                                    </form>
                                                                @endif
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endisset
        </div>

        <div class="modal fade" id="AddTeamModal" tabindex="-1" role="dialog" aria-labelledby="AddTeamModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="{{ route('team.store') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="AddTeamModalLabel">Add Team</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="order_id">Order No.</label>
                                <input type="text" class="form-control" name="order_id">
                                @if ($errors->has('order_id'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('order_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-info">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="EditTeamModal" tabindex="-1" role="dialog" aria-labelledby="EditTeamModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action method="POST">
                        @method('PUT')
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="EditTeamModalLabel">Edit Member</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Order No.</label>
                                <input type="text" class="form-control" name="order_id" disabled readonly>
                            </div>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="role">Role</label>
                                <input type="text" class="form-control" name="role" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-info">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(() => {
            $('.add-member-btn ').click(function(){
                const id = $(this).data('id')
                $('.add-member-form-'+id).toggle()
            })

            $('button[data-target="#EditTeamModal"]').click(function(){
                const route = $(this).data('route')
                const name = $(this).data('name')
                const role = $(this).data('role')
                const order_id = $(this).data('order_id')

                $('#EditTeamModal form').attr('action', route)
                $('#EditTeamModal form [name="name"]').val(name)
                $('#EditTeamModal form [name="role"]').val(role)
                $('#EditTeamModal form [name="order_id"]').val(order_id)
            })
        })
    </script>
@endpush
