@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'category'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Inventory</li>
                        <li class="breadcrumb-item active">Category</li>
                    </ol>
                </nav>
                @include('components.alerts')
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="d-flex">
                    <form action="{{ route('category.index') }}" method="GET">
                        <input type="hidden" name="active" value="true">
                        <button type="submit" class="btn btn-sm btn-default @if(request()->get('active')) active @endif @if(!request()->get('active') && !request()->get('inactive')) active @endif">Active</button>
                    </form>
                    <form action="{{ route('category.index') }}" method="GET">
                        <input type="hidden" name="inactive" value="true">
                        <button type="submit" class="btn btn-sm btn-default @if(request()->get('inactive')) active @endif">Inactive</button>
                    </form>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="mb-2 d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="mb-0 text-capitalize">{{ __('Category') }}</h5>
                                <p class="mb-0 text-muted">Manage the types of categories</p>
                            </div>
                            <div>
                                <form id="category-add-form" action="{{ route('category.store') }}" method="POST" class="d-flex justify-content-center align-items-center">
                                    @csrf
                                    <input type="text" class="form-control" id="category_name" name="name" placeholder="Enter category name">
                                    <button id="category-add" class="btn btn-sm btn-primary ml-2 my-1" type="submit">Add</button>
                                </form>                                                             
        
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        @isset($categories)
                            {{-- <div class="table-responsive-sm"> --}}
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-center">No.</th>
                                            <th scope="col">Name</th>
                                            @isset($categories[0]->user)
                                                <th scope="col">Added by</th>
                                            @endisset
                                            <th scope="col" class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                        <tr>
                                            <th scope="row" class="text-center">{{ $loop->iteration }}</th>
                                            <td>{{ $category->name }}</td>
                                            @isset($category->user)
                                                <td>{{ $category->user }}</td>
                                            @endisset
                                            <td class="text-center">
                                                @if($category->deleted_at == NULL)
                                                    <div class="d-flex justify-content-center">
                                                        <form action="{{ route('category.edit', ['category' => $category->id]) }}" method="GET">
                                                            <button type="submit" class="btn btn-sm btn-warning category-edit-btn mr-2" title="Edit">
                                                                <div class="d-flex justify-content-center align-items center">
                                                                    <svg viewBox="0 0 24 24" height="1.2rem" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                                                </div>
                                                            </button>
                                                        </form>
                                                        <form action="{{ route('category.destroy', ['category' => $category->id]) }}" method="POST">
                                                            @method('delete')
                                                            @csrf
                                                            <button type="button" class="btn btn-sm btn-danger category-delete-btn" title="Delete">
                                                                <div class="d-flex justify-content-center align-items center">
                                                                    <svg viewBox="0 0 24 24" height="1.2rem" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path><line x1="18" y1="9" x2="12" y2="15"></line><line x1="12" y1="9" x2="18" y2="15"></line></svg>
                                                                </div>
                                                            </button>
                                                        </form>
                                                    </div>
                                                @else
                                                    <form action="{{ route('category.restore', ['category' => $category->id]) }}" method="POST">
                                                        @csrf
                                                        <button type="button" class="btn btn-sm btn-info" title="Restore">
                                                            <div class="d-flex justify-content-center align-items center">
                                                                <svg viewBox="0 0 24 24" height="1.2rem" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><polyline points="1 4 1 10 7 10"></polyline><polyline points="23 20 23 14 17 14"></polyline><path d="M20.49 9A9 9 0 0 0 5.64 5.64L1 10m22 4l-4.64 4.36A9 9 0 0 1 3.51 15"></path></svg>
                                                            </div>
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            {{-- </div>   --}}
                        @endisset
                        @empty($categories)
                            <div class="alert alert-warning" role="alert">
                                No category records found!
                            </div>
                        @endempty  
                        <div class="d-flex justify-content-center align-items-center">
                            @if (request()->get('active'))
                                {{ $categories->appends(['active' => 'true'])->links() }}
                            @elseif(request()->get('inactive'))
                                {{ $categories->appends(['inactive' => 'true'])->links() }}
                            @else
                                {{ $categories->appends(['active' => 'true'])->links() }}
                            @endif
                        </div>             
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('form button[title="Delete"]').click(function(e){
            e.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                text: "You are about to "+$(this).attr('title').toUpperCase()+" this record",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: $(this).attr('title')
                }).then((result) => {
                if (result.isConfirmed) {
                    let timerInterval
                    Swal.fire({
                        title: 'Processing...',
                        html: 'Do not refresh the page. Thank you!',
                        timer: 1000,
                        timerProgressBar: true,
                        didOpen: () => {
                            Swal.showLoading()
                            const b = Swal.getHtmlContainer().querySelector('b')
                            timerInterval = setInterval(() => {
                            b.textContent = Swal.getTimerLeft()
                            }, 100)
                        },
                        willClose: () => {
                            clearInterval(timerInterval)
                        }
                    })

                    setTimeout(() => {
                        $(this).parents('form:first').submit()
                    }, 1000);
                }
            })
        })

        $('form button[title="Restore"]').click(function(e){
            e.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                text: "You are about to "+$(this).attr('title').toUpperCase()+" this record",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: $(this).attr('title')
                }).then((result) => {
                if (result.isConfirmed) {
                    let timerInterval
                    Swal.fire({
                        title: 'Processing...',
                        html: 'Do not refresh the page. Thank you!',
                        timer: 500,
                        timerProgressBar: true,
                        didOpen: () => {
                            Swal.showLoading()
                            const b = Swal.getHtmlContainer().querySelector('b')
                            timerInterval = setInterval(() => {
                                b.textContent = Swal.getTimerLeft()
                            }, 100)
                        },
                        willClose: () => {
                            clearInterval(timerInterval)
                        }
                    })

                    setTimeout(() => {
                        $(this).parents('form:first').submit()
                    }, 500);
                }
            })
        })
    </script>
@endpush