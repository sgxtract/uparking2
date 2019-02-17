@extends('layouts.admin')

@section('title')
User Information
@endsection

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 grid-margin stretch-card">
                <!--information card-->
                <div class="card">
                    
                    <div class="card-body">
                            <a href="{{ route('adminVehicles') }}" class="btn btn-secondary mb-3">Back</a>
                        <h4>User Information</h4>

                        <hr>

                        <div class="row">
                            <div class="col-md-9">
                                <address>
                                    <div class="row">
                                        <div class="col-sm-4 col-md-4">
                                            <p class="font-weight-bold">Full Name</p>
                                        </div>
                                        <div class="col-sm-8 col-md-8">
                                            <p>{{ $user->name . ' ' . $user->last_name }}</p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-4 col-md-4">
                                            <p class="font-weight-bold">Email</p>
                                        </div>
                                        <div class="col-sm-8 col-md-8">
                                            <p>{{ $user->email }}</p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-4 col-md-4">
                                            <p class="font-weight-bold">Phone No.</p>
                                        </div>
                                        <div class="col-sm-8 col-md-8">
                                            <p>{{ $user->phone_number }}</p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-4 col-md-4">
                                            <p class="font-weight-bold">Member since</p>
                                        </div>
                                        <div class="col-sm-8 col-md-8">
                                            <p>
                                                @php
                                                $unixTime = strtotime($user->created_at);
                                                echo date('F j, Y', $unixTime);
                                                @endphp
                                            </p>
                                        </div>
                                    </div>
                                </address>
                            </div>
                        </div>

                        <hr>

                        <h4>Registered Vehicles ( {{ $user->vehicles->count() }} )</h4>
                        <hr>

                        @if ($user->vehicles->isEmpty())
                            <h5 class="text-center mt-4">No registered vehicle.</h5>
                        @else
                            <address>
                            @foreach ($user->vehicles as $vehicle)
                                <div class="row">
                                    <div class="col-sm-2 col-md-2">
                                        <p class="font-weight-bold">Plate No.</p>
                                    </div>
                                    <div class="col-sm-3 col-md-3">
                                        <p>{{ $vehicle->plate_number }}</p>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-sm-2 col-md-2">
                                        <p class="font-weight-bold">Type</p>
                                    </div>
                                    <div class="col-sm-3 col-md-3">
                                        <p>{{ $vehicle->type }}</p>
                                    </div>
                                </div>
                                <hr>
                                @endforeach
                            </address>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        {{-- information End Row --}}
    </div>
</div>
@endsection
