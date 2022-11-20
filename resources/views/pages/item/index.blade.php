@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'item'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Inventory</li>
                        <li class="breadcrumb-item active">Package Items</li>
                    </ol>
                </nav>
                @include('components.alerts')
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-2 d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Package Items</h5>
                            <a href="{{ route('item.create') }}" class="btn btn-sm btn-primary">Add Item</a>
                        </div>
                        @isset($items)                        
                            <div class="table-responsive-sm">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No.</th>
                                            <th>Name</th>
                                            <th>Category</th>
                                            @isset($items[0]->user)
                                                <th>Added By</th>
                                            @endisset
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($items as $item)
                                            <tr>
                                                <th scope="row" class="text-center">{{ $loop->iteration }}</th>
                                                <td>{{ $item->name }}</td>
                                                <td>
                                                    @isset($item->category_name)
                                                        {{ $item->category_name }}
                                                    @endisset
                                                    @empty($item->category_name)
                                                        <span class="text-danger">Error: Missing data!</span>
                                                    @endempty
                                                </td>
                                                @isset($item->user)
                                                    <td>{{ $item->user }}</td>
                                                @endisset
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        @if($item->deleted_at == NULL)
                                                            <form action="{{ route('item.edit', ['item' => $item->id]) }}" method="GET">
                                                                <button type="submit" class="btn btn-sm btn-warning mr-2" title="Edit">
                                                                    <div class="d-flex justify-content-center align-items center">
                                                                        <svg viewBox="0 0 24 24" height="1.2rem" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                                                    </div>
                                                                </button>
                                                            </form>
                                                            <form action="{{ route('item.destroy', ['item' => $item->id]) }}" method="POST">
                                                                @method('delete')
                                                                @csrf
                                                                <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                                                    <div class="d-flex justify-content-center align-items center">
                                                                        <svg viewBox="0 0 24 24" height="1.2rem" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path><line x1="18" y1="9" x2="12" y2="15"></line><line x1="12" y1="9" x2="18" y2="15"></line></svg>
                                                                    </div>
                                                                </button>
                                                            </form>
                                                        @else
                                                            <form action="{{ route('item.restore', ['item' => $item->id]) }}" method="POST">
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
                        @endisset

                        @empty($items)
                            <div class="alert alert-warning" role="alert">
                                No item records found!
                            </div>
                        @endempty
                        <div class="d-flex justify-content-center align-items-center">
                            {{ $items->links() }}
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