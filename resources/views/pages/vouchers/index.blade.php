@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'voucher'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item active">Voucher</li>
                    </ol>
                </nav>
                @include('components.alerts')
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 mx-auto">
                @isset($vouchers) 
                <div class="card">
                    <div class="card-body">
                        <div class="mb-2 d-flex justify-content-between align-items-start">
                            <div>
                                <h5 class="mb-0 text-capitalize">{{ __('Vouchers') }}</h5>
                                <p class="mb-0 text-muted">Manage package vouchers</p>
                            </div>
                            <a href="" class="btn btn-success" data-toggle="modal" data-target="#GenerateVoucherModal">Add Voucher</a>
                        </div>                  
                        <div class="table-responsive-sm">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">No.</th>
                                        <th>Code</th>
                                        <th>Discount</th>
                                        <th>Expire Date</th>
                                        <th>Created On</th>
                                        <th>Last Update</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($vouchers as $v)
                                        <tr>
                                            <th scope="row" class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $v->code }}</td>
                                            <td>{{ json_decode($v->data)->discount }}%</td>
                                            <td>
                                                @if ($v->expires_at == NULL)
                                                    N/A
                                                @else
                                                    {{ Carbon\Carbon::parse($v->expires_at)->toFormattedDateString() }}
                                                @endif
                                            </td>
                                            <td>{{ $v->created_at->toFormattedDateString() }}</td>
                                            <td>{{ $v->updated_at->toFormattedDateString() }}</td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    @if($v->deleted_at == NULL)
                                                        <form action="{{ route('voucher.destroy', ['voucher' => $v->id]) }}" method="POST">
                                                            @method('delete')
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                                                <div class="d-flex justify-content-center align-items center">
                                                                    <svg viewBox="0 0 24 24" height="1.2rem" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path><line x1="18" y1="9" x2="12" y2="15"></line><line x1="12" y1="9" x2="18" y2="15"></line></svg>
                                                                </div>
                                                            </button>
                                                        </form>
                                                    @else
                                                        <form action="{{ route('voucher.restore', ['voucher' => $v->id]) }}" method="POST">
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
                            {{ $vouchers->links() }}
                        </div>
                    </div>
                </div>
                @endisset
                
                @empty($vouchers)
                    <div class="alert alert-warning" role="alert">
                        No item records found!
                    </div>
                @endempty
            </div>
        </div>
        <div class="modal fade" id="GenerateVoucherModal" tabindex="-1" role="dialog" aria-labelledby="GenerateVoucherModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="{{ route('voucher.store') }}" method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title" id="GenerateVoucherModalLabel">Generate Voucher</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @csrf
                            <div class="form-group">
                                <label>Select Package</label>
                                <select class="form-control" name="package_id" required>
                                    <option selected disabled></option>
                                    @foreach ($packages as $p)
                                        <option value="{{ $p->package_id }}">{{ $p->package_name }}</option>
                                    @endforeach
                                </select>
                                <small class="form-text text-muted">Select a specific package to bind the voucher to.</small>
                            </div>
                            <div class="form-group">
                                <label>Discount</label>
                                <div class="input-group mb-3">
                                    <input type="number" class="form-control" name="discount" min="0" oninput="this.value = Math.abs(this.value)" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text px-2 py-0 bg-light">%</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Expiry Date</label>
                                <input type="date" class="form-control" name="expires_at">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Generate</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
