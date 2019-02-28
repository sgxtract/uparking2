@extends('layouts.admin')
@section('title')
Check In
@endsection
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-3"></div>
            <div class="col-xl-6 col-lg-6 col-md-6">
                <div class="form-group">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
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
                    <h4 class="text-center display-4 mb-5 mt-2">Check In</h4>
                    <form action="{{ route('slotCheckInSearch') }}" method="POST">
                        @csrf
                        <div class="input-group col-xs-12">
                                <select class="form-control" name="plate_number" id="">
                                    @foreach ($vehicles as $vehicle)
                                    <option>{{ $vehicle->plate_number }}</option>
                                    @endforeach
                                </select>
                            <span class="input-group-append">
                                <button type="submit" class="btn btn-dark btn-fw">
                                    <i class="mdi mdi-magnify"></i>Check in</button>
                            </span>
                        </div>
                    </form>
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
