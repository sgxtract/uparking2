@extends('layouts.admin')
@section('title')
User Dashboard
@endsection
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-xl-2 col-lg-2 col-md-2"></div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
                <div class="card card-statistics">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                <i class="mdi mdi-car text-warning icon-lg"></i>
                            </div>
                            <div class="float-right">
                                <p class="mb-0 text-right">Vehicles</p>
                                <div class="fluid-container">
                                    <h3 class="font-weight-medium text-right mb-0">{{ $vehicles->count() }}</h3>
                                </div>
                            </div>
                        </div>
                        <p class="text-muted mt-3 mb-0">
                            <i class="mdi mdi-car-connected mr-1" aria-hidden="true"></i> Most used vehicle
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
                <div class="card card-statistics">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                <i class="mdi mdi-calendar-check text-info icon-lg"></i>
                            </div>
                            <div class="float-right">
                                <p class="mb-0 text-right">Reserves</p>
                                <div class="fluid-container">
                                    <h3 class="font-weight-medium text-right mb-0">{{ 'Wala pa!' }}</h3>
                                </div>
                            </div>
                        </div>
                        <p class="text-muted mt-3 mb-0">
                            <i class="mdi mdi-calendar mr-1" aria-hidden="true"></i> Weekly Reserves
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
                            <h3>Monday</h3>
                            <p class="text-gray">
                                <span class="weather-date">25 October, 2016</span>
                                <span class="weather-location">London, UK</span>
                            </p>
                        </div>
                        <div class="weather-data d-flex">
                            <div class="mr-auto">
                                <h4 class="display-3">21
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
    </div>
    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->
    <footer class="footer">
        <div class="container-fluid clearfix">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2018
                <a href="http://www.bootstrapdash.com/" target="_blank">Grawlix Corp.</a>. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with
                <i class="mdi mdi-heart text-danger"></i>
            </span>
        </div>
    </footer>
    <!-- partial -->
</div>
<!-- main-panel ends -->

{{-- {!! $chart->script() !!} --}}
@endsection
