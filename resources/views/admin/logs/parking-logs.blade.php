@extends('layouts.admin')

@section('title')
Admin History
@endsection

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><span class="mdi mdi-calendar-clock"></span> Parking Logs</h4>

                        @if ($logs->isEmpty())
                            <h5 class="text-center mt-5">No records found.</h5>
                        @else

                        <hr>

                        <div class="table-responsive">
                            <table id="parking-logs" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Slot Number</th>
                                        <th>Plate Number</th>
                                        <th>Payment</th>
                                        <th>Date</th>
                                        <th>Time In</th>
                                        <th>Time Out</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($logs as $log)
                                    <tr>
                                        <td>
                                            @if ($log->user_id == 0)
                                                {{ 'Guest' }}
                                            @endif
                                            @if ($log->user_id != 0)
                                                {{ $log->user->name }}
                                            @endif
                                        </td>
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
                                <tfoot>
                                    <tr>
                                        <th>User</th>
                                        <th>Slot Number</th>
                                        <th>Plate Number</th>
                                        <th>Payment</th>
                                        <th>Time In</th>
                                        <th>Time Out</th>
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
        $('#parking-logs').DataTable();
    } );
</script>

@endsection
