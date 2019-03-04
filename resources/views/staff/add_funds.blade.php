@extends('layouts.admin')

@section('title')
Add Funds
@endsection

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><span class="mdi mdi-calendar-clock"></span> Add Funds</h4>

                        <hr>

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        
                        <div class="table-responsive">
                            <table id="addFundsTable" class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Email</th>
                                        <th>Vehicles</th>
                                        <th>Balance</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($wallets as $wallet)
                                    <tr>
                                        @if (!$wallet->user->admin && !$wallet->user->staff)
                                            <td>
                                                <input type="hidden" id="user-name" value="{{ $wallet->user->name }}">
                                                {{ $wallet->user->name . ' ' . $wallet->user->last_name }}
                                            </td>
                                            <td>{{ $wallet->user->email }}</td>
                                            <td><label class="badge badge-success">{{ \App\Vehicle::where('user_id',
                                                    $wallet->user_id)->count() }}</label></td>
                                            <td><label>₱ {{ number_format($wallet->balance, 2) }}</label></td>
                                            <td><a href="{{ route('staffContinueUserFunds', $wallet->user_id) }}" class="badge badge-warning">Add Funds</a></td>
                                        @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>User</th>
                                        <th>Email</th>
                                        <th>Vehicles</th>
                                        <th>Balance</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Add Funds Modal --}}
        <div id="addFundsModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Select Amount</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body" id="">
                        <div class="row text-center">
                            <div class="col-md-12">
                                <form action=""> <!-- Form Start -->
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-check-label">
                                                <input type="radio" onclick="funds()" name="add_funds" value="100"> ₱ 100
                                            </label>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-check-label">
                                                <input type="radio" onclick="funds()" name="add_funds" value="300"> ₱ 300
                                            </label>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-check-label">
                                                <input type="radio" onclick="funds()" name="add_funds" value="500"> ₱ 500
                                            </label>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-check-label">
                                                <input type="radio" onclick="funds()" name="add_funds" value="1000"> ₱ 1000
                                            </label>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12 font-weight-bold">Summary</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6"><p>To pay</p></div>
                                        <div class="col-md-6"><p>₱ <span id="toPay"></span></p></div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12"><a href="" class="btn btn-primary btn-sm btn-block"><i class="fab fa-paypal"></i> PayPal checkout</a></div>
                                    </div>
                                </form> <!-- Form End -->
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- Add Funds Modal End --}}
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#addFundsTable').DataTable();
    });

    $(document).ready(function () {
        $('.add_funds').click(function () {
            $('#addFundsModal').modal("show");
        });
    });
</script>
@endsection
