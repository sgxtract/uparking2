@extends('layouts.admin')

@section('title')
Load Wallet
@endsection

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 grid-margin">
                <!--balance card-->
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><i class="menu-icon mdi mdi-wallet"></i> Load Wallet</h4>

                        <hr>

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

            <div class="col-md-1"></div>
            <div class="col-xl-4 col-lg-4 col-md-4 grid-margin">
                <!--vehicle card-->
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><i class="menu-icon mdi mdi-wallet"></i> Add Funds</h4>

                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        
                        <hr>
                        {{-- Row 1 Start --}}
                        <div class="row">
                            <div class="col-md-12">
                                {{-- Form Start --}}
                                <form action="{{ route('pay.continueCheckOut', $wallet->user_id) }}" method="POST">
                                    @csrf
                                    {{-- Row 2 Start --}}
                                    <div class="row">
                                        <div class="col-sm-3 col-md-3">
                                            <div class="form-group">
                                                <label><input type="radio" onclick="func()" name="options" value="100">
                                                    ₱ 100</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-md-3">
                                            <div class="form-group">
                                                <label><input type="radio" onclick="func()" name="options" value="300">
                                                    ₱ 300</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-md-3">
                                            <div class="form-group">
                                                <label><input type="radio" onclick="func()" name="options" value="500">
                                                    ₱ 500</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-md-3">
                                            <div class="form-group">
                                                <label><input type="radio" onclick="func()" name="options" value="1000">
                                                    ₱ 1000</label>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Row 2 End --}}
                                    <hr>
                                    {{-- Row 3 Start --}}
                                    <div class="row">
                                        <div class="col-md-12">
                                            Summary
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p>To pay: </p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="float-right">₱ <span id="toPay"></span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <button type="submit" class="btn btn-info btn-block">Continue</button>
                                    {{-- Row 3 End --}}
                                </form>
                                {{-- Form End --}}
                            </div>
                        </div>
                        {{-- Row 1 End --}}
                    </div>
                </div>
                <!--vehicle card ends-->
            </div>
        </div>

    </div>
</div>

<script>
    function func() {
        var val = document.querySelector('input[name="options"]:checked').value;
        document.getElementById("toPay").innerHTML = val;
    }

</script>

@endsection
