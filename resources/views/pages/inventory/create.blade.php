@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'inventory'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Add Items</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('inventory.index') }}" class="btn btn-sm btn-dark">Back</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
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