@extends('layouts.admin')
@section('title')
Staff Dashboard
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
                                <i class="mdi mdi-comment text-success icon-lg"></i>
                            </div>
                            <div class="float-right">
                                <p class="mb-0 text-right">Reserves</p>
                                <div class="fluid-container">
                                    <h3 class="font-weight-medium text-right mb-0">{{ Auth::user()->count() }}</h3>
                                </div>
                            </div>
                        </div>
                        <p class="text-muted mt-3 mb-0">
                            <i class="mdi mdi-calendar mr-1" aria-hidden="true"></i> Weekly Reserves
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
                <div class="card card-statistics">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                <i class="mdi mdi-account-location text-info icon-lg"></i>
                            </div>
                            <div class="float-right">
                                <p class="mb-0 text-right">Total Reserves</p>
                                <div class="fluid-container">
                                    <h3 class="font-weight-medium text-right mb-0">{{ Auth::user()->count() }}</h3>
                                </div>
                            </div>
                        </div>
                        <p class="text-muted mt-3 mb-0">
                            <i class="mdi mdi-reload mr-1" aria-hidden="true"></i> Product-wise sales
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <!--weather card-->
                <div class="card">
                    <div class="card-header">Reserves by week</div>
                    <div class="card-body">
                        {{-- {!! $chart->container() !!} --}}
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
            <span class="text-muted d-block text-center text-center">Copyright © 2018
                <a href="http://www.tonagnis.com/" target="_blank">Grawlix Corp</a>. All rights reserved.</span>
        </div>
    </footer>
    <!-- partial -->
</div>
<!-- main-panel ends -->

{{-- {!! $chart->script() !!} --}}
@endsection
