@extends('layouts.admin')
@section('title')
Check Out
@endsection
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="display-4">Check Out</h4>
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

                        <hr>

                        @if ($vehicles->isEmpty())
                            <h5 class="text-center mt-5">No occupied to check out.</h5>
                        @else
                            <div class="table-responsive">
                                <table id="checkIn" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Plate Number</th>
                                            <th>Slot Number</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($vehicles as $vehicle)
                                        <tr>
                                            <td>
                                                @if ($vehicle->user_id == 0)
                                                    Guest
                                                @else
                                                    {{ $vehicle->user->name . ' ' . $vehicle->user->last_name }}
                                                @endif
                                            </td>
                                            <td>{{ $vehicle->plate_number }}</td>
                                            <td>{{ $vehicle->slot_number }}</td>
                                            <td>{{ $vehicle->status }}</td>
                                            <td>
                                                <a href="{{ route('slotCheckOutSearch', $vehicle->plate_number) }}" class="badge badge-danger">Check Out</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Plate Number</th>
                                            <th>Slot Number</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- <form action="{{ route('slotCheckInSearch') }}" method="POST">
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
                    </form> --}}

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

    <script>
        $(document).ready(function() {
            $('#checkIn').DataTable();
        } );
    </script>
    @endsection
