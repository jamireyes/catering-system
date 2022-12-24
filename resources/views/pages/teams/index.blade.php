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
            <div class="col-md-12 mb-2">
                <h5 class="text-xl mb-0">Teams</h5>
                <a class="btn btn-info" href="{{ route('team.create') }}">Add Team</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="card text-left">
                    <div class="card-body" style="height: 22.75rem; max-height: 25rem; overflow-x:auto;">
                        {{-- <p class="card-text">Order No: 5000</p> --}}
                        <div class="table-responsive-sm">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col" class="font-weight-normal">Name</th>
                                        <th scope="col" class="font-weight-normal">Role</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>John Doe</td>
                                        <td>Head Organizer</td>
                                    </tr>
                                    <tr>
                                        <td>John Doe</td>
                                        <td>Head Organizer</td>
                                    </tr>
                                    <tr>
                                        <td>John Doe</td>
                                        <td>Head Organizer</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
