@extends('layouts.admin')

@section('title')
    Income Sales Report
@endsection

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><span class="mdi mdi-account-multiple"></span> Daily Income Sales</h4>
                        @if (session('success'))
                            <div class="alert alert-success">
                                {!! session('success') !!}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger">
                                {!! session('error') !!}
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

                        <div class="table-responsive">
                            <table id="" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Day</th>
                                        <th>Number of reserves</th>
                                        <th>Total Income</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>Sunday</th>
                                        <td>{{ $dataCtr['sun'] }}</td>
                                        <td>₱ {{ number_format($data['sunday'], 2) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Monday</th>
                                        <td>{{ $dataCtr['mon'] }}</td>
                                        <td>₱ {{ number_format($data['monday'], 2) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tuesday</th>
                                        <td>{{ $dataCtr['tue'] }}</td>
                                        <td>₱ {{ number_format($data['tuesday'], 2) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Wednesday</th>
                                        <td>{{ $dataCtr['wed'] }}</td>
                                        <td>₱ {{ number_format($data['wednesday'], 2) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Thursday</th>
                                        <td>{{ $dataCtr['thu'] }}</td>
                                        <td>₱ {{ number_format($data['thursday'], 2) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Friday</th>
                                        <td>{{ $dataCtr['fri'] }}</td>
                                        <td>₱ {{ number_format($data['friday'], 2) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Saturday</th>
                                        <td>{{ $dataCtr['sat'] }}</td>
                                        <td>₱ {{ number_format($data['saturday'], 2) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <script>
    $(document).ready(function() {
        $('#incomeSales').DataTable();
    });
</script> --}}

@endsection
