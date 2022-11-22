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
                        <li class="breadcrumb-item active">Occasion</li>
                    </ol>
                </nav>
                @include('components.alerts')
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 mx-auto">
                @isset($occasions) 
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-2 d-flex justify-content-between align-items-start">
                                <div>
                                    <h5 class="mb-0 text-capitalize">{{ __('Occasions') }}</h5>
                                    <p class="mb-0 text-muted">Manage the type of occasions</p>
                                </div>
                                <a href="{{ route('occasion.create') }}" class="btn btn-sm btn-primary">Add Occasion</a>
                            </div>                  
                            <div class="table-responsive-sm">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No.</th>
                                            <th>Name</th>
                                            <th>Created On</th>
                                            <th>Last Update</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($occasions as $o)
                                        <tr>
                                            <th scope="row" class="text-center">{{ $loop->iteration }}</th>
                                            <td>{{ $o->name }}</td>
                                            <td>{{ $o->created_at->toFormattedDateString() }}</td>
                                            <td>{{ $o->updated_at->toFormattedDateString() }}</td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    @if($o->deleted_at == NULL)
                                                        <form action="{{ route('occasion.edit', ['occasion' => $o->id]) }}" method="GET">
                                                            <button type="submit" class="btn btn-sm btn-warning mr-2" title="Edit">
                                                                <div class="d-flex justify-content-center align-items center">
                                                                    <svg viewBox="0 0 24 24" height="1.2rem" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                                                </div>
                                                            </button>
                                                        </form>
                                                        <form action="{{ route('occasion.destroy', ['occasion' => $o->id]) }}" method="POST">
                                                            @method('delete')
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                                                <div class="d-flex justify-content-center align-items center">
                                                                    <svg viewBox="0 0 24 24" height="1.2rem" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path><line x1="18" y1="9" x2="12" y2="15"></line><line x1="12" y1="9" x2="18" y2="15"></line></svg>
                                                                </div>
                                                            </button>
                                                        </form>
                                                    @else
                                                        <form action="{{ route('occasion.restore', ['occasion' => $o->id]) }}" method="POST">
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm btn-info" title="Restore">
                                                                <div class="d-flex justify-content-center align-items center">
                                                                    <svg viewBox="0 0 24 24" height="1.2rem" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><polyline points="1 4 1 10 7 10"></polyline><polyline points="23 20 23 14 17 14"></polyline><path d="M20.49 9A9 9 0 0 0 5.64 5.64L1 10m22 4l-4.64 4.36A9 9 0 0 1 3.51 15"></path></svg>
                                                                </div>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-center align-items-center">
                                {{ $occasions->links() }}
                            </div>
                        </div>
                    </div>
                @endisset

                @empty($occasions)
                    <div class="alert alert-warning" role="alert">
                        No item records found!
                    </div>
                @endempty
            </div>
        </div>
    </div>
@endsection
