@extends('layouts.admin')

@section('title')
Vehicle
@endsection

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-xl-8 col-lg-8 col-md-8 grid-margin stretch-card">
                <!--vehicle card-->
                <div class="card">
                    <div class="card-body">
                        <h4>Vehicle Information</h4>
                        <p class="card-description">
                            <small>These are the list of your registered vehicles.</small>
                        </p>
                        <hr>

                        @if (session('success2'))
                            <div class="alert alert-danger">
                                {{ session('success2') }}
                            </div>
                            @endif

                        @if ($vehicles->isEmpty())
                            <h5 class="text-center mt-5">No registered vehicle.</h5>
                        @else
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Plate Number</th>
                                        <th>Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($vehicles as $vehicle)
                                    <tr>
                                        <td>{{ $vehicle->plate_number }}</td>
                                        <td>{{ $vehicle->type }}</td>
                                        <td>
                                            <form style="display: none" method="POST" id="deleteVehicle-{{ $vehicle->id }}" action="{{ route('userRemoveVehicle', $vehicle->id) }}">@csrf</form>
                                            <a href="{{ route('userEditVehicle', $vehicle->id) }}" class="btn btn-warning btn-sm"><span class="mdi mdi-pencil"></span> Update</a>
                                            <button type="button" class="btn btn-danger btn-sm" onclick="document.getElementById('deleteVehicle-{{ $vehicle->id }}').submit()"><span class="mdi mdi-delete-forever"></span> Remove</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @endif
                    </div>
                </div>
                <!--vehicle card ends-->
            </div>
            {{-- <div class="col-xl-3 col-lg-3 col-md-3"></div> --}}
            <div class="col-xl-4 col-lg-4 col-md-4 grid-margin">
                <!--vehicle card-->
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('userAddVehicle') }}" method="POST">
                            @csrf
                            <h4>Add a vehicle</h4>
                            <p class="card-description">
                                <small>Input your vehicle information.</small>
                            </p>

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

                            @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            <hr>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Plate No.</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="plate_number" value="" class="form-control{{ $errors->has('plate_number') ? ' is-invalid' : '' }}"
                                                placeholder="ABC####" />
                                        </div>
                                        {{--
                                        <div class="col-sm-4">
                                            <input type="text" name="plate_number" value="" class="form-control{{ $errors->has('plate_number') ? ' is-invalid' : '' }}"
                                                placeholder="####" />
                                        </div> --}}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Type</label>
                                        <div class="col-sm-8">
                                            <select class="form-control form-control-sm" name="type">
                                                <option value="Sedan">Sedan</option>
                                                <option value="SUV">(SUV) Sports Utility Vehicle</option>
                                                <option value="MPV">(MPV) Multi-Purpose Vehicle</option>
                                                <option value="Minivan">Minivan</option>
                                                <option value="Truck">Truck</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <button type="submit" class="btn btn-info">Add vehicle</button>

                        </form>
                    </div>
                </div>
                <!--vehicle card ends-->
            </div>
        </div>
    </div>
</div>
@endsection
