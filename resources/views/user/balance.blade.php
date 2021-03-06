@extends('layouts.admin')

@section('title')
Load Wallet
@endsection

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-3"></div>
            <div class="col-xl-6 col-lg-6 col-md-6 grid-margin">
                <!--balance card-->
                <div class="card bg-dark text-white">
                    <div class="card-body">
                        <h4 class="card-title text-white"><i class="menu-icon mdi mdi-wallet"></i> Load Wallet</h4>
                        <a href="#" class="badge badge-warning add_funds">Add Funds <span class="mdi mdi-credit-card-plus"></span></a>

                        <hr>

                        @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif

                        @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                        @endif

                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="list-ticked">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        @if (!($wallet->status))
                        <div class="row">
                            <div class="col-md-12 text-center">
                                Wallet not yet activated.
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button type="button" class="btn btn-info">
                                    Activate Online Wallet
                                </button>
                            </div>
                        </div>
                        @else
                        <div class="row">
                            <div class="col-md-12">
                                <h4>Load Balance: ₱ {{ number_format($wallet->balance, 2, '.', ',') }}</h4>
                                <p class="text-muted mt-3 mb-0">
                                    <i class="mdi mdi-car-connected mr-1" aria-hidden="true"></i> Load balance must
                                    have a minimum amount of ₱100.00 to reserve.
                                </p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                <!--balance card ends-->
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
                                <!-- Form Start -->
                                <form action="{{ route('pay.continueCheckOut', $wallet->user_id) }}" method="POST"">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-check-label">
                                                <input type="radio" onclick="func()" name="options" value="100"> ₱ 100
                                            </label>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-check-label">
                                                <input type="radio" onclick="func()" name="options" value="300"> ₱ 300
                                            </label>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-check-label">
                                                <input type="radio" onclick="func()" name="options" value="500"> ₱ 500
                                            </label>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-check-label">
                                                <input type="radio" onclick="func()" name="options" value="1000"> ₱ 1000
                                            </label>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12 font-weight-bold">Summary</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p>To pay</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p>₱ <span id="toPay"></span></p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary btn-sm btn-block">Continue</button>
                                        </div>
                                    </div>
                                </form>
                                <!-- Form End -->
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
    function func() {
        var val = document.querySelector('input[name="options"]:checked').value;
        document.getElementById("toPay").innerHTML = val;
    }

    $(document).ready(function () {
        $('.add_funds').click(function () {
            $('#addFundsModal').modal("show");
        });
    });

</script>

@endsection
