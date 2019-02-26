@extends('layouts.admin')
@section('title')
Check Out
@endsection
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-xl-2 col-lg-2 col-md-2"></div>
            <div class="col-xl-8 col-lg-8 col-md-8 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Confirm Check Out <span class="mdi mdi-check-circle"></span></h3>
                        <hr>
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-3">Information</div>
                            <div class="col-md-3"></div>
                            <div class="col-md-3">Summary</div>
                            <div class="col-md-3"></div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-3">
                                <p class="font-weight-bold">Plate Number: </p>
                            </div>
                            <div class="col-md-3">
                                <p>{{ $check_out->plate_number }}</p>
                            </div>
                            <div class="col-md-3">
                                <p class="font-weight-bold">Time in:</p>
                            </div>
                            <div class="col-md-3">
                                <p>{{ $check_out->created_at }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <p class="font-weight-bold">Slot Number:</p>
                            </div>
                            <div class="col-md-3">
                                <p>{{ $check_out->slot_number }}</p>
                            </div>
                            <div class="col-md-3">
                                <p class="font-weight-bold">Time out:</p>
                            </div>
                            <div class="col-md-3">
                                <p>{{ $check_out->updated_at }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <p class="font-weight-bold">Walk in:</p>
                            </div>
                            <div class="col-md-3">
                                <p>
                                    @if ($check_out->walk_in)
                                        Yes
                                    @else
                                        No
                                    @endif
                                </p>
                            </div>
                            <div class="col-md-3">
                                <p class="font-weight-bold">Total time of stay:</p>
                            </div>
                            <div class="col-md-3">
                                <p>{{ number_format($totalTime, 2) }} (hour/s)</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-3"></div>
                            <div class="col-md-3">
                                <p class="font-weight-bold">To pay:</p>
                            </div>
                            <div class="col-md-3">
                                <p>₱ {{ number_format($toPay, 2) }}</p>
                            </div>
                        </div>
                        <hr>
                        <form style="display: none" method="POST" id="checkout" action="{{ route('slotCheckOut', $check_out->slot_number) }}">@csrf</form>
                        <button type="button" class="btn btn-success btn-sm mr-2 float-right" onclick="document.getElementById('checkout').submit()">Check Out</button>
                        <a href="{{ route('staffCheckOut') }}" class="btn btn-light">Back</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
            <div class="container-fluid clearfix">
                <span class="text-muted d-block text-center text-center">Copyright © 2019
                    <a href="http://www.tonagnis.com/" target="_blank">Grawlix Corp</a>. All rights reserved.</span>
            </div>
        </footer>
        <!-- partial -->
    </div>
    <!-- main-panel ends -->

    {{-- {!! $chart->script() !!} --}}
    @endsection
