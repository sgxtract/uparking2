@extends('layouts.admin')

@section('title')
    Admin Users
@endsection

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><span class="mdi mdi-account-multiple"></span> Admin Users</h4>
                        <a href="{{ route('adminNewUser') }}" class="btn btn-info btn-sm">New User</a>
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

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Date of Registration</th>
                                        <th>Updated at</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td><a href="{{ route('adminSingleUser', $user->id) }}">{{ $user->name . ' ' . $user->last_name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->phone_number }}</td>
                                            <td>
                                                @php
                                                    $unixTime = strtotime($user->created_at);
                                                    echo date('F j, Y @ g:i a', $unixTime);
                                                @endphp
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($user->updated_at)->diffForHumans() }}</td>
                                            <td>
                                                <form style="display: none" method="POST" id="deleteUser-{{ $user->id }}" action="{{ route('adminDeleteUser', $user->id) }}">@csrf</form>
                                                <a href="{{ route('adminEditUser', $user->id) }}" class="btn btn-warning btn-sm"><span class="mdi mdi-pencil"></span></a>
                                                <button type="button" class="btn btn-danger btn-sm" onclick="document.getElementById('deleteUser-{{ $user->id }}').submit()"><span class="mdi mdi-delete-forever"></span></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
