@extends('layouts.admin')

@section('title')
User History
@endsection

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        {{-- <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><span class="mdi mdi-calendar-clock"></span> User History</h4>
                        
                        @if ($logs->isEmpty())
                            <h5 class="text-center mt-5">No records found.</h5>
                        @else

                        <hr>

                        <div class="table-responsive">
                            <table class="table table-hover table-dark">
                                <thead>
                                    <tr class="text-info">
                                        <th>User</th>
                                        <th>Description</th>
                                        <th>IP Address</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($logs as $log)
                                        <tr>
                                            <td>{{ $log->user->name . ' ' . $log->user->last_name }}</td>
                                            <td>{{ $log->description }}</td>
                                            <td>{{ $log->ip_address }}</td>
                                            <td>
                                                @php
                                                    $unixTime = strtotime($log->created_at);
                                                    echo date('F j, Y', $unixTime);
                                                @endphp
                                            </td>
                                            <td>
                                                @php
                                                    $unixTime = strtotime($log->created_at);
                                                    echo date('g:i a', $unixTime);
                                                @endphp
                                            </td>
                                            <td>{{ $log->action }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $logs->links() }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <hr> --}}
        
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><span class="mdi mdi-calendar-clock"></span> Parking History</h4>
                        
                        @if ($reserve_logs->isEmpty())
                            <h5 class="text-center mt-5">No records found.</h5>
                        @else

                        <hr>

                        <div class="table-responsive">
                            <table id="userHistory" class="table table-hover">
                                <thead>
                                    <tr class="text-info">
                                        <th>Slot Number</th>
                                        <th>Vehicle</th>
                                        <th>Payment</th>
                                        <th>Date</th>
                                        <th>Time In</th>
                                        <th>Time Out</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reserve_logs as $log)
                                        <tr>
                                            <td>{{ $log->slot_number }}</td>
                                            <td>{{ $log->plate_number }}</td>
                                            <td>₱ {{ number_format($log->payment, 2) }}</td>
                                            <td>
                                                @php
                                                    $unixTime = strtotime($log->created_at);
                                                    echo date('F j, Y', $unixTime);
                                                @endphp
                                            </td>
                                            <td>
                                                @php
                                                    $unixTime = strtotime($log->created_at);
                                                    echo date('g:i a', $unixTime);
                                                @endphp
                                            </td>
                                            <td>
                                                @php
                                                    $unixTime = strtotime($log->updated_at);
                                                    echo date('g:i a', $unixTime);
                                                @endphp
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
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
        $('#userHistory').DataTable();
    } );
</script>

@endsection
