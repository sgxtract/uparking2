@extends('layouts.admin')

@section('title')
Vehicle
@endsection

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">

            <div class="col-xl-6 col-lg-6 col-md-6 grid-margin">
                <!--User Information Card-->
                <div class="card">
                    <div class="card-body">
                        <h4>User Information</h4>
                        <hr>
                        {{-- Name --}}
                        <div class="row">
                            <div class="col-md-3 font-weight-bold text-primary"><p>Name</p></div>
                            <div class="col-md-9"><p>{{ $user->name . ' ' . $user->last_name }}</p></div>
                        </div>
                        {{-- Load Wallet --}}
                        <div class="row">
                            <div class="col-md-3 font-weight-bold text-primary"><p>Wallet</p></div>
                            <div class="col-md-9"><p>₱ {{ number_format($wallet->balance, 2) }}</p></div>
                        </div>
                        {{-- Email --}}
                        <div class="row">
                            <div class="col-md-3 font-weight-bold text-primary"><p>Email</p></div>
                            <div class="col-md-9"><p>{{ $user->email }}</p></div>
                        </div>
                        {{-- Vehicles --}}
                        <div class="row">
                            <div class="col-md-3 font-weight-bold text-primary"><p>Vehicle</p></div>
                            <div class="col-md-9"><p>{{ \App\Vehicle::where('user_id', $id)->count() }}</p></div>
                        </div>
                    </div>
                </div>
                <!--User Information Card End-->
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 grid-margin stretch-card">
                
                <div class="card">
                    <div class="card-body">

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
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
                        
                        <h4>Add Funds ₱</h4>
                        <p class="class-description">
                            <small>Select load amount.</small>
                        </p>
                        <hr>
                        <div class="row text-center">
                            <div class="col-md-12">
                                <!-- Form Start -->
                                <form action="{{ route('pay.checkOutUserFunds', $id) }}" method="POST"">
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
                                            <button type="submit" class="btn btn-primary btn-sm btn-block"><i class="fab fa-paypal"></i> PayPal checkout</button>
                                        </div>
                                    </div>
                                </form>
                                <!-- Form End -->
                            </div>
                        </div>
                    </div>
                </div>
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
