@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'package'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('package.index') }}">Package Management</a></li>
                        <li class="breadcrumb-item active">Create Package</li>
                    </ol>
                  </nav>
                <h3 class="mt-5">Create Package</h3>
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