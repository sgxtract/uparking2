@extends('layouts.admin')
@section('title')
Check Out
@endsection
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-3"></div>
            <div class="col-xl-6 col-lg-6 col-md-6">
                <div class="form-group">
                    <h4 class="text-center">Check Out</h4>
                    <div class="input-group col-xs-12">
                        <input type="text" class="form-control" placeholder="Search Plate No.">
                        <span class="input-group-append">
                            <button type="button" class="btn btn-dark btn-fw">
                                    <i class="mdi mdi-magnify"></i>Search</button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-2 col-lg-2 col-md-2"></div>
            <div class="col-xl-8 col-lg-8 col-md-8 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        Infos
                    </div>
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
