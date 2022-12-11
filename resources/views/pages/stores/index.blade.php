@extends('layouts.app', [
    'class' => 'lock-page',
    'elementActive' => 'catering-page',
    'backgroundImagePath' => ''
])

@section('content')
    <div class="container-fluid">
        <div class="px-2 py-4">
            <div class="row">
                <div class="col-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('welcome') }}" class="text-muted">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a class="text-dark">Stores</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="grid-container">
                        @foreach ($stores as $s)
                            <div class="card store-card" data-id="{{ $s->id }}" data-route="{{ route('store.show', ['store' => $s->id]) }}">
                                <div class="card-body">
                                    <div class="d-flex">
                                        @if($s->image)
                                            <img class="avatar" src="{{asset('/storage/images/'.$s->image)}}" alt="profile_image">
                                        @endif
                                        <div class="card-info ml-3 text-gray">
                                            <h5 class="text-lg">{{ $s->name }}</h5>
                                            <table>
                                                <tbody>
                                                    @if($s->full_address != ' ')
                                                        <tr>
                                                            <td class="align-top pt-1 pr-3"><span class="nc-icon nc-pin-3"/></td>
                                                            <td class="align-middle"><small>{{ $s->full_address }}</small></td>
                                                        </tr>
                                                    @endif
                                                    @if($s->phone_number)
                                                        <tr>
                                                            <td class="align-top pt-1 pr-3"><span class="nc-icon nc-send"/></td>
                                                            <td class="align-middle"><small>+63 {{ $s->phone_number }}</small></td>
                                                        </tr>
                                                    @endif
                                                    @if($s->email)
                                                        <tr>
                                                            <td class="align-top pt-1 pr-3"><span class="nc-icon nc-email-85"/></td>
                                                            <td class="align-middle"><small>{{ $s->email }}</small></td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



@push('scripts')
    <script>
        $(document).ready(() => {
            $('.store-card').click(function(){
                const route = $(this).data('route');

                window.location.href = route;
            });
        })
    </script>
@endpush