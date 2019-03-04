@extends('layouts.admin')

@section('title')
    Reserves
@endsection

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Reserves <span class="mdi mdi-car-side"></span></h4>
                            
                            @if ($reserves->isEmpty())
                                <h5 class="text-center mt-5">No records found.</h5>
                            @else

                            <div class="table-responsive">
                                <table id="reservesView" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Slot Number</th>
                                            <th>Plate Number</th>
                                            <th>Time of Reservation</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($reserves as $reserve)
                                        <tr>
                                            <td>{{ $reserve->slot_number }}</td>
                                            <td>{{ $reserve->plate_number }}</td>
                                            <td>
                                                @php
                                                    $unixTime = strtotime($reserve->created_at);
                                                    echo date('g:ia', $unixTime);
                                                @endphp
                                            </td>
                                            <td>
                                                <form style="display: none" method="POST" id="cancelReserve-{{ $reserve->slot_number }}" action="{{ route('staffCancelReserve', $reserve->slot_number) }}">@csrf</form>
                                                <a href="#" class="badge badge-danger" onclick="document.getElementById('cancelReserve-{{ $reserve->slot_number }}').submit()">Cancel</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Slot Number</th>
                                            <th>Plate Number</th>
                                            <th>Time of Reservation</th>
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
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#reservesView').DataTable();
        });
    </script>
@endsection