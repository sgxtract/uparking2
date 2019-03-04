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
                        <h4 class="card-title"><span class="mdi mdi-calendar-clock"></span> User Logs</h4>

                        @if ($logs->isEmpty())
                            <h5 class="text-center mt-5">No records found.</h5>
                        @else

                        <hr>

                        <div class="table-responsive">
                            <table id="user-logs" class="table table-striped">
                                <thead>
                                    <tr>
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
                                        @if ($log->type == 'user')
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
                                        @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>User</th>
                                        <th>Description</th>
                                        <th>IP Address</th>
                                        <th>Date</th>
                                        <th>Time</th>
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
        $('#user-logs').DataTable();
    } );
</script>

@endsection