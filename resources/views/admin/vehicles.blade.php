@extends('layouts.admin')

@section('title')
Admin Vehicles
@endsection

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 grid-margin stretch-card">
                <!--vehicle card-->
                <div class="card">
                    <div class="card-body">
                        <h4>Registered Vehicles</h4>
                        <p class="card-description">
                            <small>List of all registered vehicles.</small>
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
                            <table id="adminVehicles" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Owner</th>
                                        <th>Plate Number</th>
                                        <th>Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($vehicles as $vehicle)
                                    <tr>
                                        <td><a href="{{ route('adminSingleUser', $vehicle->user->id) }}">{{ $vehicle->user->name . ' ' . $vehicle->user->last_name }}</a></td>
                                        <td>{{ $vehicle->plate_number }}</td>
                                        <td>{{ $vehicle->type }}</td>
                                        <td>
                                            <form style="display: none" method="POST" id="deleteVehicle-{{ $vehicle->id }}" action="{{ route('adminRemoveVehicle', $vehicle->id) }}">@csrf</form>
                                            <button type="button" class="btn btn-danger btn-sm" onclick="document.getElementById('deleteVehicle-{{ $vehicle->id }}').submit()"><span class="mdi mdi-delete-forever"></span></button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Owner</th>
                                        <th>Plate Number</th>
                                        <th>Type</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        @endif
                    </div>
                </div>
                <!--vehicle card ends-->
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#adminVehicles').DataTable();
    } );
</script>

@endsection
