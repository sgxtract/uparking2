@extends('layouts.admin')

@section('title')
Admin Dashboard
@endsection

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
                <div class="card card-statistics bg-dark text-white">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                <i class="mdi mdi-car text-primary icon-lg"></i>
                            </div>
                            <div class="float-right">
                                <p class="mb-0 text-right text-primary font-weight-bold">Total Vehicles</p>
                                <div class="fluid-container">
                                    <h3 class="font-weight-medium text-right mb-0">{{ \App\Vehicle::all()->count() }}</h3>
                                </div>
                            </div>
                        </div>
                        <p class="text-muted mt-3 mb-0">
                            <i class="mdi mdi-information-outline mr-1" aria-hidden="true"></i>Number of registered vehicles
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
                                <p class="mb-0 text-right text-primary font-weight-bold">Total Reserves</p>
                                <div class="fluid-container">
                                    <h3 class="font-weight-medium text-right mb-0">{{ \App\Reserve_Log::all()->count() }}</h3>
                                </div>
                            </div>
                        </div>
                        <p class="text-muted mt-3 mb-0">
                            <i class="mdi mdi-information-outline mr-1" aria-hidden="true"></i>Total number of reserves
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
                <div class="card card-statistics bg-dark text-white">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                <i class="mdi mdi-account-multiple text-success icon-lg"></i>
                            </div>
                            <div class="float-right">
                                <p class="mb-0 text-right text-primary font-weight-bold">Total Users</p>
                                <div class="fluid-container">
                                    <h3 class="font-weight-medium text-right mb-0">{{ \App\User::all()->count() }}</h3>
                                </div>
                            </div>
                        </div>
                        <p class="text-muted mt-3 mb-0">
                            <i class="mdi mdi-information-outline mr-1" aria-hidden="true"></i>Number of registered users
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
                <div class="card card-statistics bg-dark text-white">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                <i class="mdi mdi-car-side text-warning icon-lg"></i>
                            </div>
                            <div class="float-right">
                                <p class="mb-0 text-right text-primary font-weight-bold">Reserves</p>
                                <div class="fluid-container">
                                    <h3 class="font-weight-medium text-right mb-0">{{ \App\Reserve::where('status', 'reserved')->count() }}</h3>
                                </div>
                            </div>
                        </div>
                        <p class="text-muted mt-3 mb-0">
                            <i class="mdi mdi-information-outline mr-1" aria-hidden="true"></i> Current reserves
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
                <div class="card card-statistics bg-dark text-white">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                <i class="mdi mdi-map-marker-off text-danger icon-lg"></i>
                            </div>
                            <div class="float-right">
                                <p class="mb-0 text-right text-primary font-weight-bold">Occupied</p>
                                <div class="fluid-container">
                                    <h3 class="font-weight-medium text-right mb-0">{{ \App\Reserve::where('status', 'occupied')->count() }}</h3>
                                </div>
                            </div>
                        </div>
                        <p class="text-muted mt-3 mb-0">
                            <i class="mdi mdi-information-outline mr-1" aria-hidden="true"></i>Current number of occupied slots
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
                <div class="card card-statistics bg-dark text-white">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                <i class="mdi mdi-map-marker-radius text-light icon-lg"></i>
                            </div>
                            <div class="float-right">
                                <p class="mb-0 text-right text-primary font-weight-bold">Available Slots</p>
                                <div class="fluid-container">
                                    <h3 class="font-weight-medium text-right mb-0">{{ \App\Reserve::where('status', 'free')->count() }}</h3>
                                </div>
                            </div>
                        </div>
                        <p class="text-muted mt-3 mb-0">
                            <i class="mdi mdi-information-outline mr-1" aria-hidden="true"></i>Parking slots available
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- content-wrapper ends -->
<!-- partial:partials/_footer.html -->
<footer class="footer">
    <div class="container-fluid clearfix text-center">
        <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright &copy; 2019
            <a href="http://www.bootstrapdash.com/" target="_blank">Grawlix Corp.</a>. All rights reserved.</span>
    </div>
</footer>
<!-- partial -->
</div>
<!-- main-panel ends -->

@endsection
