@extends('layouts.admin')
@section('title')
User Dashboard
@endsection
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        
            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
        <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
                <div class="card card-statistics bg-dark text-white">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                <i class="mdi mdi-clock text-success icon-lg"></i>
                            </div>
                            <div class="float-right">
                                <p class="mb-0 text-right">Last login</p>
                                <div class="fluid-container">
                                    <h3 class="font-weight-medium text-right mb-0">{{ $user->last_sign_in_at->diffForHumans() }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
                <div class="card card-statistics bg-dark text-white">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                <i class="mdi mdi-car text-info icon-lg"></i>
                            </div>
                            <div class="float-right">
                                <p class="mb-0 text-right">My Vehicles</p>
                                <div class="fluid-container">
                                    <h3 class="font-weight-medium text-right mb-0">{{ $vehicles->count() }}</h3>
                                </div>
                            </div>
                        </div>
                        <p class="text-muted mt-3 mb-0">
                            <button type="button" id="viewVehicles" class="btn btn-inverse-info btn-rounded btn-fw">View vehicles</button>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
                <div class="card card-statistics bg-dark text-white">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                <i class="mdi mdi-calendar-check text-warning icon-lg"></i>
                            </div>
                            <div class="float-right">
                                <p class="mb-0 text-right">My Reserves</p>
                                <div class="fluid-container">
                                    <h3 class="font-weight-medium text-right mb-0">{{ $reserves2->count() }}</h3>
                                </div>
                            </div>
                        </div>
                        <p class="text-muted mt-3 mb-0">
                            <button type="button" id="getData" class="btn btn-inverse-warning btn-rounded btn-fw view_data">View reserve</button>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <!--weather card-->
                <div class="card card-weather">
                    <div class="card-body">
                        <div class="weather-date-location">
                            <h3>Friday</h3>
                            <p class="text-gray">
                                <span class="weather-date">01 March, 2019</span>
                                <span class="weather-location">Manila, Philippines</span>
                            </p>
                        </div>
                        <div class="weather-data d-flex">
                            <div class="mr-auto">
                                <h4 class="display-3">26
                                    <span class="symbol">&deg;</span>C</h4>
                                <p>
                                    Mostly Cloudy
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="d-flex weakly-weather">
                            <div class="weakly-weather-item">
                                <p class="mb-0">
                                    Sun
                                </p>
                                <i class="mdi mdi-weather-cloudy"></i>
                                <p class="mb-0">
                                    30°
                                </p>
                            </div>
                            <div class="weakly-weather-item">
                                <p class="mb-1">
                                    Mon
                                </p>
                                <i class="mdi mdi-weather-hail"></i>
                                <p class="mb-0">
                                    31°
                                </p>
                            </div>
                            <div class="weakly-weather-item">
                                <p class="mb-1">
                                    Tue
                                </p>
                                <i class="mdi mdi-weather-partlycloudy"></i>
                                <p class="mb-0">
                                    28°
                                </p>
                            </div>
                            <div class="weakly-weather-item">
                                <p class="mb-1">
                                    Wed
                                </p>
                                <i class="mdi mdi-weather-pouring"></i>
                                <p class="mb-0">
                                    30°
                                </p>
                            </div>
                            <div class="weakly-weather-item">
                                <p class="mb-1">
                                    Thu
                                </p>
                                <i class="mdi mdi-weather-pouring"></i>
                                <p class="mb-0">
                                    29°
                                </p>
                            </div>
                            <div class="weakly-weather-item">
                                <p class="mb-1">
                                    Fri
                                </p>
                                <i class="mdi mdi-weather-snowy-rainy"></i>
                                <p class="mb-0">
                                    31°
                                </p>
                            </div>
                            <div class="weakly-weather-item">
                                <p class="mb-1">
                                    Sat
                                </p>
                                <i class="mdi mdi-weather-snowy"></i>
                                <p class="mb-0">
                                    32°
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!--weather card ends-->
            </div>
        </div>

        {{-- Reserve Modal --}}
        <div id="dataModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Reserve Information <span class="mdi mdi-information 
                            icon-sm"></span></h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body" id="parking_detail">
                            @if ($reserves2->count() == 0)
                                <h5 class="text-center">You have no current reserves.</h5>
                            @else
                            <div class="row text-center">
                                <div class="col-md-4">Slot Number</div>
                                <div class="col-md-4">Plate Number</div>
                            </div>
                            <hr>
                                @foreach ($reserves as $reserve)
                                    @if ($reserve->status == 'reserved')
                                        <div class="row text-center">
                                            <div class="col-md-4"><p>{{ $reserve->slot_number }}</p></div>
                                            <div class="col-md-4"><p>{{ $reserve->plate_number }}</p></div>
                                            <div class="col-md-4">
                                                <form style="display: none" method="POST" id="cancelReserve-{{ $reserve->slot_number }}" action="{{ route('userCancelReserve', $reserve->slot_number) }}">@csrf</form>
                                                <a href="#" class="badge badge-danger" onclick="document.getElementById('cancelReserve-{{ $reserve->slot_number }}').submit()">Cancel</a>    
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- Reserve Modal End --}}

        {{-- Vehicles Modal --}}
        <div id="dataModal2" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Vehicle Lists <span class="mdi mdi-information 
                            icon-sm"></span></h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body" id="parking_detail">
                            @if ($vehicles->isEmpty())
                                <h5 class="text-center">You have no registered vehicle/s.</h5>
                            @else
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-4">Type</div>
                                <div class="col-md-4">Plate Number</div>
                                <div class="col-md-2"></div>
                            </div>
                            <hr>
                                @foreach ($vehicles as $vehicle)
                                    <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-4"><p>{{ $vehicle->type }}</p></div>
                                        <div class="col-md-4"><p>{{ $vehicle->plate_number }}</p></div>
                                        <div class="col-md-2"></div>
                                    </div>
                                @endforeach
                            @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- Vehicles Modal End --}}
    </div>
    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->
    <footer class="footer">
        <div class="container-fluid clearfix">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2019
                <a href="http://www.parking-ally.com/" target="_blank">Grawlix Corp.</a>. All rights reserved.</span>
            </span>
        </div>
    </footer>
    <!-- partial -->
    
</div>
<!-- main-panel ends -->

<script>
    $(document).ready(function(){
        $('.view_data').click(function(){
            $('#dataModal').modal("show");
        });
    });

    $(document).ready(function(){
        $('#viewVehicles').click(function(){
            $('#dataModal2').modal("show");
        });
    });
</script>

{{-- {!! $chart->script() !!} --}}
@endsection
