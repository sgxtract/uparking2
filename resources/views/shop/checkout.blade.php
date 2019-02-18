@extends('layouts.admin')

@section('title')
Load Wallet
@endsection

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-3 grid-margin"></div>
            <div class="col-xl-6 col-lg-6 col-md-6 grid-margin">
                <!--checkout card-->
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><i class="menu-icon mdi mdi-wallet"></i> Transaction Confirmation</h4>

                        @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                        @endif

                        <hr>
                        {{-- Row 1 Start --}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        Summary
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p>To pay: </p>
                                            </div>
                                            <div class="col-md-6">
                                                <p class="float-right">₱ {{ number_format($amount, 2, '.', ',') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <a href="{{ route('pay.checkoutOrder',  [$amount, $id]) }}" class="btn btn-info btn-block">Checkout with PayPal</a>
                            </div>
                        </div>
                        {{-- Row 1 End --}}
                    </div>
                </div>
                <!--checkout card ends-->
            </div>
        </div>

    </div>
</div>

@endsection
