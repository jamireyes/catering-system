@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'inventory'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Inventory Management</li>
                    </ol>
                </nav>
                @include('components.alerts')
            </div>
        </div>
        <div class="row">
            @if(Auth::user()->role == 'ADMIN')
            <div class="col-md-4 col-sm-5">
                <div class="card">
                    <div class="card-body">
                        <h5>Category</h5>
                        <div class="mb-4">
                            <form id="category-add-form" action="{{ route('category.store') }}" method="POST" class="d-flex justify-content-center align-items-center">
                                @csrf
                                <input type="text" class="form-control" id="category_name" name="name" placeholder="Enter category name">
                                <button id="category-add" class="btn btn-sm btn-primary py-2 mx-1" type="submit">Add</button>
                            </form>
    
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        @isset($categories)
                            <div class="table-responsive-sm">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="text-center">
                                            <th>No.</th>
                                            <th>Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td class="d-flex justify-content-center">
                                                @if($category->deleted_at == NULL)
                                                    <button class="btn btn-warning category-edit-btn mr-2" data-id="{{ $category->id }}">
                                                        <svg viewBox="0 0 24 24" height="1.2rem" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                                    </button>
                                                    <form action="{{ route('category.destroy', ['category' => $category->id]) }}" method="POST">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger category-delete-btn">
                                                            <svg viewBox="0 0 24 24" height="1.2rem" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path><line x1="18" y1="9" x2="12" y2="15"></line><line x1="12" y1="9" x2="18" y2="15"></line></svg>
                                                        </button>
                                                    </form>
                                                @else
                                                    <form action="{{ route('category.restore', ['category' => $category->id]) }}" method="POST">
                                                        @csrf
                                                        <input type="submit" class="btn btn-sm btn-info" value="Restore">
                                                    </form>
                                                @endif
                                                
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>  
                        @endisset
                        @empty($categories)
                            <div class="alert alert-warning" role="alert">
                                No category records found!
                            </div>
                        @endempty               
                    </div>
                </div>
            </div>
            @endif
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5>Items</h5>
                            <a href="{{ route('inventory.create') }}" class="btn btn-sm btn-primary">Add Items</a>
                        </div>
                        @isset($items)                        
                            <div class="table-responsive-sm">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Category</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($items as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->description }}</td>
                                                <td>{{ $item->category->name }}</td>
                                                <td></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endisset

                        @empty($items)
                            <div class="alert alert-warning" role="alert">
                                No item records found!
                            </div>
                        @endempty
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
            
            $('.category-edit-btn').on('click', function(){
                const { value: category_name } = await Swal.fire({
                    title: 'Update Category!',
                    input: 'category_name',
                    inputLabel: 'Edit category name',
                    inputValue: $(this).data('id'),
                })
    
                if (category_name) {
                    Swal.fire(`Entered category: ${category_name}`)
                }
            });

        })
    </script>
@endpush