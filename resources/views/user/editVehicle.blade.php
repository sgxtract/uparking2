@extends('layouts.admin')

@section('title')
Vehicle
@endsection

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-xl-2 col-lg-2 col-md-2"></div>
            <div class="col-xl-8 col-lg-8 col-md-8 grid-margin stretch-card">
                <!--vehicle card-->
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('userEditVehicle', $vehicle->id) }}" method="POST">
                            @csrf
                            <h4>Update vehicle</h4>
                            <p class="card-description">
                                <small>Update vehicle information.</small>
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
                                        <label class="col-sm-4 col-form-label">Change Plate No.</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="plate_number" value="{{ $vehicle->plate_number }}" class="form-control{{ $errors->has('plate_number') ? ' is-invalid' : '' }}"
                                                placeholder="ABC####" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Change Type</label>
                                        <div class="col-sm-8">
                                            <select class="form-control form-control-sm" name="type">
                                                <option value="Sedan"{{ $vehicle->type == 'Sedan' ? 'selected' : '' }}>Sedan</option>
                                                <option value="SUV"{{ $vehicle->type == 'SUV' ? 'selected' : '' }}>(SUV) Sports Utility Vehicle</option>
                                                <option value="MPV"{{ $vehicle->type == 'MPV' ? 'selected' : '' }}>(MPV) Multi-Purpose Vehicle</option>
                                                <option value="Minivan"{{ $vehicle->type == 'Minivan' ? 'selected' : '' }}>Minivan</option>
                                                <option value="Truck"{{ $vehicle->type == 'Truck' ? 'selected' : '' }}>Truck</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <button type="submit" class="btn btn-info">Save changes</button>

                        </form>
                    </div>
                </div>
                <!--vehicle card ends-->
            </div>
        </div>
    </div>
</div>
@endsection
