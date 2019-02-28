@extends('layouts.admin')
@section('title')
Check In
@endsection
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-xl-2 col-lg-2 col-md-2"></div>
            <div class="col-xl-8 col-lg-8 col-md-8 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Confirm Check In <span class="mdi mdi-check-circle"></span></h3>
                        <hr>
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-3">Information</div>
                            <div class="col-md-3"></div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-3">
                                <p class="font-weight-bold">Slot Number: </p>
                            </div>
                            <div class="col-md-3">
                                <p>{{ $check_in->slot_number }}</p>
                            </div>
                            <div class="col-md-3">
                                <p class="font-weight-bold">Name:</p>
                            </div>
                            <div class="col-md-3">
                                <p>{{ $user->name . ' ' . $user->last_name }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <p class="font-weight-bold">Plate Number:</p>
                            </div>
                            <div class="col-md-3">
                                <p>{{ $check_in->plate_number }}</p>
                            </div>
                            <div class="col-md-3">
                                <p class="font-weight-bold">Phone Number:</p>
                            </div>
                            <div class="col-md-3">
                                <p>{{ $user->phone_number }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <p class="font-weight-bold">Status:</p>
                            </div>
                            <div class="col-md-3">
                                <p>{{ ucfirst($check_in->status) }}</p>
                            </div>
                            <div class="col-md-3">
                                <p class="font-weight-bold">Email:</p>
                            </div>
                            <div class="col-md-3">
                                <p>{{ $user->email }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <p class="font-weight-bold">Time reserved:</p>
                            </div>
                            <div class="col-md-3">
                                <p>
                                    @php
                                        $unixTime = strtotime($check_in->created_at);
                                        echo date('M. d - g:i a', $unixTime);
                                    @endphp
                                </p>
                            </div>
                            <div class="col-md-3">
                                <p class="font-weight-bold">Load Balance:</p>
                            </div>
                            <div class="col-md-3">
                                <p>₱ {{ number_format($wallet->balance, 2) }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <p class="font-weight-bold">Walk in:</p>
                            </div>
                            <div class="col-md-3">
                                <p>
                                    @if ($check_in->walk_in)
                                        Yes
                                    @else
                                        No
                                    @endif
                                </p>
                            </div>
                        </div>
                        <hr>
                        <form style="display: none" method="POST" id="checkout" action="{{ route('slotCheckInReserve', $check_in->slot_number) }}">@csrf</form>
                        <button type="button" class="btn btn-success btn-sm mr-2 float-right" onclick="document.getElementById('checkout').submit()">Check In</button>
                        <a href="{{ route('staffCheckIn') }}" class="btn btn-light">Back</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
            <div class="container-fluid clearfix">
                <span class="text-muted d-block text-center text-center">Copyright © 2019
                    <a href="http://www.parking-ally.com/" target="_blank">Grawlix Corp</a>. All rights reserved.</span>
            </div>
        </footer>
        <!-- partial -->
    </div>
    <!-- main-panel ends -->

    {{-- {!! $chart->script() !!} --}}
    @endsection
