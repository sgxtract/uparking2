@extends('layouts.admin')

@section('title')
Vehicle
@endsection

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2"></div>
            <div class="col-xl-8 col-lg-8 col-md-8 grid-margin stretch-card">
                <!--vehicle card-->
                <div class="card">
                    <div class="card-body">
                        <button type="button" class="btn btn-primary btn-sm float-right add_vehicle">Register your
                            vehicle here <span class="mdi mdi-plus"></span></button>
                        <h4>Vehicle Information</h4>
                        <p class="card-description">
                            <small>These are the list of your registered vehicles.</small>
                        </p>
                        <hr>

                        @if (session('success'))
                            <div class="alert alert-danger">
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
                                <ul class="list-ticked">
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if ($vehicles->isEmpty())
                        <h5 class="text-center mt-5">No registered vehicle.</h5>
                        @else

                        <div class="table-responsive">
                            <table class="table table-hover">
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
                                            <form style="display: none" method="POST" id="deleteVehicle-{{ $vehicle->id }}"
                                                action="{{ route('userRemoveVehicle', $vehicle->id) }}">@csrf</form>
                                            <a href="{{ route('userEditVehicle', $vehicle->id) }}" class="badge badge-warning"><span
                                                    class="mdi mdi-pencil"></span> Update</a>
                                            <a href="#" class="badge badge-danger" onclick="document.getElementById('deleteVehicle-{{ $vehicle->id }}').submit()"><span
                                                    class="mdi mdi-delete-forever"></span> Remove</a>
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
        </div>

        {{-- Add Vehicle Modal --}}
        <div id="addVehicleModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Register a vehicle</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Form Start -->
                    <form action="{{ route('userAddVehicle') }}" method="POST"">
                            @csrf
                            <div class="
                        modal-body" id="">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Enter plate number</label>
                                    <input type="text" name="plate_number" value="" class="form-control{{ $errors->has('plate_number') ? ' is-invalid' : '' }}" placeholder="ABC###" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Select Vehicle Type</label>
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
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-sm btn-block">Submit</button>
                    </div>
                    </form>
                    <!-- Form End -->
                </div>
            </div>
        </div>
        {{-- Add Vehicle Modal End --}}
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.add_vehicle').click(function () {
            $('#addVehicleModal').modal("show");
        });
    });

</script>
@endsection
